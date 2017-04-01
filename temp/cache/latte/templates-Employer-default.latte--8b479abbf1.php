<?php
// source: C:\xampp\htdocs\cviceni03b\app\presenters/templates/Employer/default.latte

use Latte\Runtime as LR;

class Template8b479abbf1 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['e'])) trigger_error('Variable $e overwritten in foreach on line 26');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<h1>Zaměstnanci</h1>

<p>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Pid:default")) ?>">Rodná čísla</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Company:default")) ?>">Firmy</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Statistic:default")) ?>">Statistiky</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:default")) ?>">Menu</a>
</p>

<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("add")) ?>">Vytvoř</a>
<div class="table-empl">
    <div class="table-row-empl">
        <div>Firma</div>
        <div>Jméno</div>
        <div>Příjmení</div>
        <div>Rodné číslo</div>
        <div>Pohlaví</div>
        <div>Datum narození</div>
        <div>Plat</div>
        <div>Daň</div>
        <div class="twocol">Akce</div>

    </div>
<?php
		$iterations = 0;
		foreach ($employers as $e) {
?>
            <div class="table-row-empl">
                <div><?php echo LR\Filters::escapeHtmlText($e->company->name) /* line 28 */ ?> </div>
                <div><a href="http://www.kdejsme.cz/jmeno/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($e->surname)) /* line 29 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($e->surname) /* line 29 */ ?></a></div>
                <div><a href="http://www.kdejsme.cz/prijmeni/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($e->firstname)) /* line 30 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($e->firstname) /* line 30 */ ?></a></div>
<?php
			if ($e->pid) {
				?>                <div><?php echo LR\Filters::escapeHtmlText($e->pid->name) /* line 32 */ ?></div>
<?php
			}
			else {
?>
                <div>unknown</div>
<?php
			}
			?>                <div><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->sex, $e->pid)) /* line 36 */ ?></div>
<?php
			if ($e->pid) {
				?>                <div><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->birthday, $e->pid)) /* line 38 */ ?></div>
<?php
			}
			else {
?>
                    <div>unknown</div>
<?php
			}
			?>                <div><?php echo LR\Filters::escapeHtmlText($e->salary) /* line 42 */ ?></div>
                <div><?php echo LR\Filters::escapeHtmlText($e->salary * 0.22) /* line 43 */ ?></div>
                <div class="twocol">
                <div><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("edit", ['id' => $e->id])) ?>">Edituj</a></div>
                <div><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("delete", ['id' => $e->id])) ?>">Odeber</a></div>
                </div>
            </div>
<?php
			$iterations++;
		}
		?></div><?php
	}

}
