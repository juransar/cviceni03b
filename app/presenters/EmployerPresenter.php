<?php

namespace App\Presenters;

use App\Model\EmployerModel;
use App\Model\CompanyModel;
use App\Forms\EmployerFormFactory;
use App\Model\UtilityModel;
use Nette\Application\UI\Form;
use App\Model\NoDataFound;
use Tracy\Debugger;



class EmployerPresenter extends BasePresenter
{
    /** @var EmployerFormFactory - Formulářová továrnička pro správu zaměstanců */
    private $formFactory;

    /** @var EmployerModel - model pro management zaměstanců */
    private $employerModel;

    /** @var UserModel - model pro management firem */
    private $companyModel;

    private $utilityModel;
    public function injectDependencies(EmployerFormFactory $formFactory,CompanyModel $companyModel,EmployerModel $employerModel,UtilityModel $utilityModel)
    {
        $this->formFactory = $formFactory;
        $this->companyModel= $companyModel;
        $this->employerModel=$employerModel;
        $this->utilityModel=$utilityModel;
    }
    /**
     * Akce pro vkádání
     */
    public function actionAdd() {
        $form = $this['addForm'];
        try {
            $companies = $this->companyModel->listCompanies();
            $c = [];
            foreach($companies as $company)
                $c[$company['id']] = $company['name'];
            $form['company_id']->setItems($c);
        } catch (NoDataFound $e) {
            $form->addError('Nelze načíst data');
        }
    }

    /**
     * Akce pro editaci
     * @param int $id id zaměstnance
     */
    public function actionEdit($id) {
        $form = $this['editForm'];
        try {
            $companies = $this->companyModel->listCompanies();
            $c = [];
            foreach($companies as $company)
                $c[$company['id']] = $company['name'];
            $form['company_id']->setItems($c);
            $employer = $this->employerModel->getEmployer($id);
            $form->setDefaults($employer);
        } catch (NoDataFound $e) {
            $form->addError('Nelze načíst data');
        }
    }

    /**
     * Akce pro mazání
     * @param int $id id zaměstnance
     */
    public function actionDelete($id) {
        $form = $this['deleteForm'];
        $form['id']->setDefaultValue($id);
    }

    /**
     * Metoda pro vytvoření formuláře pro vložení
     * @return Form - formulář
     */
    public function createComponentAddForm()
    {
        $form = $this->formFactory->createAddForm();
        $form->onSuccess[] = function (Form $form) {
            $this->redirect('Employer:default');
        };
        return $form;
    }

    /**
     * Metoda pro vytvoření formuáře pro editaci
     * @return Form - formulář
     */
    public function createComponentEditForm()
    {
        $form = $this->formFactory->createEditForm();
        $form->onSuccess[] = function (Form $form) {
            $this->redirect('Employer:default');
        };
        return $form;
    }

    /**
     * Metoda pro vytvoření formuláře pro mazání
     * @return Form - formulář
     */
    public function createComponentDeleteForm()
    {
        $form = $this->formFactory->createDeleteForm();
        $form->onSuccess[] = function (Form $form) {
            $this->redirect('Employer:default');
        };
        return $form;
    }

    /**
     * Metoda pro naplnění dat pro šablonu dané akce
     */
    public function renderEdit($id) {
        $employer = $this->employerModel->getEmployer($id);
        $this->template->name = $employer['surname'];
    }

    /**
     * Metoda pro naplnění dat pro šablonu dané akce
     */
    public function renderDelete($id) {
        $employer = $this->employerModel->getEmployer($id);
        $this->template->name = $employer['surname'];
    }

    /**
     * Metoda pro naplnění dat pro šablonu dané akce
     */
    public function renderDefault() {
       $this->template->employers = $this->employerModel->listEmployers();
    }
    protected function beforeRender()
    {

        $this->template->addFilter('sex', function ($id) {
            $gender= $this->utilityModel->isMan($id);
            switch($gender){
                case 1:
                    $gender="muz";break;
                case 0:
                    $gender="zena";break;
                case -1:
                    $gender="nedef";break;
            }
            return $gender;
        });
        $this->template->addFilter('birthday', function ($id) {
            return $this->utilityModel->getBirthDay($id);
        });
    }

}
