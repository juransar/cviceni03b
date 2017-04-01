<?php

namespace App\Forms;

use App\Model\CompanyModel;


use Services\MyValidators;
use Exception;
use Kdyby\Translation\Phrase;
use Nette\Application\UI\Form;
use Nette\Forms\Container;
use Nette\Utils\ArrayHash;
use Tracy\Debugger;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\Json;
use Nette\Utils\Strings;
use Nette\Object;

/**
 * Továrnička na tvorbu formulářů pro správu firem
 *
 * @author     Jiří Chludil
 * @author     Jindřich Máca
 * @copyright  Copyright (c) 2017 Jiří Chludil
 * @package    App\Forms
 */
class CompanyFormFactory extends Object
{
    /** @var CompanyModel Model pro správu firem. */
    private $companyModel;

    public function injectDependencies(CompanyModel $companyModel)
    {
        $this->companyModel= $companyModel;
    }
    /** @inheritdoc */
    protected function addCommonFields(Container &$form, $args = null)
    {
        $form->addText('name', 'Příjmení')
            ->setAttribute('placeholder', 'Vyplň jméno')
            ->setRequired('Je třeba vyplnit jméno');
        $form->addText('phone', 'Telefon')
            ->setAttribute('placeholder', 'Vyplń telefon')
            ->setRequired('Je třeba vyplnit telefon');
        $form->addCheckbox('is_dph', 'Plátce DPH?');
    }


    /**
     * Vytváří komponentu formuláře pro přidávání nové firmy.
     * @param null|array $args další argumenty
     * @return Form formulář pro přidávání nové firmy
     */
    public function createAddForm($args = null)
    {
        $form = new Form(NULL, 'addForm');
        $form->addProtection('Ochrana');
        $this->addCommonFields($form);
        $form->addSubmit('send', 'Přidej');
        $form->onSuccess[] = [$this, "newFormSucceeded"];
        return $form;
    }

    /**
     * Vytváří komponentu formuláře pro editaci firmy.
     * @param null|array $args další argumenty
     * @return Form formulář pro editaci firmy
     */
    public function createEditForm($args = null)
    {
        $form = new Form(NULL, 'editForm');
        $form->addProtection('Ochrana');
        $this->addCommonFields($form);
        $form->addSubmit('send', 'Aktualizuj');
        $form->addHidden('id');
        $form->onSuccess[] = [$this, "editFormSucceeded"];
        return $form;
    }

    /**
     * Vytváří komponentu formuláře pro smazání firmy.
     * @param null|array $args další argumenty
     * @return Form formulář pro smazání firmy
     */
    public function createDeleteForm($args = null)
    {
        $form = new Form(NULL, 'deleteForm');
        $form->addProtection('Ochrana');
        $form->addSubmit('send', 'Odeber');
        $form->addHidden('id');
        $form->onSuccess[] = [$this, "deleteFormSucceeded"];
        return $form;
    }

    /**
     * Zpracování validních dat z formuláře a následného přidání firmy.
     * @param Form      $form   formulář
     * @param ArrayHash $values data
     */
    public function newFormSucceeded(Form $form, ArrayHash $values)
    {
        try {
            $this->companyModel->insertCompany($values);
        } catch (Exception $exception) {
            $form->addError($exception);
        }
    }

    /**
     * Zpracování validních dat z formuláře a následné aktualizace firmy
     * @param Form      $form   formulář
     * @param ArrayHash $values data
     */
    public function editFormSucceeded(Form $form, ArrayHash $values)
    {
        try {
            $id = $values['id'];
            unset($values['id']);
            $this->companyModel->updateCompany($id, $values);
        } catch (Exception $exception) {
            Debugger::log($e);
            $form->addError($exception);
        }
    }

    /**
     * Zpracování validních dat z formuláře a následného odebrání firmy.
     * @param Form      $form   formulář
     * @param ArrayHash $values data
     */
    public function deleteFormSucceeded(Form $form, ArrayHash $values)
    {
        try {
            $this->companyModel->deleteCompany($values['id']);
        } catch (Exception $exception) {
            $form->addError($exception);
        }
    }

}
