<?php
// source: C:\xampp\htdocs\cviceni03b\app\presenters/templates/Company/default.latte

use Latte\Runtime as LR;

class Template00c805deca extends Latte\Runtime\Template
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
		if (isset($this->params['c'])) trigger_error('Variable $c overwritten in foreach on line 41');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<h1>Firmy</h1>

<p>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Pid:default")) ?>">Rodná čísla</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Employer:default")) ?>">Zaměstnanci</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Statistic:default")) ?>">Statistika</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:default")) ?>">Menu</a>
</p>
<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("add")) ?>">Vytvoř</a>
<div class="table-comp">
    <div class="table-row-comp">
        <div>Jméno</div>
        <div>Registrace</div>
        <div>Je plátce DPH?</div>
        <div>Telefon</div>
        <div class="twocol">Akce</div>
    </div>
<?php
		$iterations = 0;
		foreach ($companies as $c) {
?>
        <div class="table-row-comp">
            <div><?php echo LR\Filters::escapeHtmlText($c->name) /* line 43 */ ?></div>
            <div><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $c->registered, "j.n.Y - G:i:s")) /* line 44 */ ?></div>
            <div><?php echo LR\Filters::escapeHtmlText($c->is_dph ? 'ano' : 'ne') /* line 45 */ ?></div>
            <div><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->phone, $c->phone)) /* line 46 */ ?></div>
            <div class="twocol">
                <div><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("edit", ['id' => $c->id])) ?>">Edituj</a></div>
                <div><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("delete", ['id' => $c->id])) ?>">Odeber</a></div>
            </div>
        </div>
<?php
			$iterations++;
		}
		?></div><?php
	}

}
