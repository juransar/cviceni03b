<?php
// source: C:\xampp\htdocs\cviceni03b\app\presenters/templates/Statistic/default.latte

use Latte\Runtime as LR;

class Template99a996a799 extends Latte\Runtime\Template
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
		if (isset($this->params['s'])) trigger_error('Variable $s overwritten in foreach on line 20');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<h1>Statistiky</h1>

<p>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Pid:default")) ?>">Rodná čísla</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Company:default")) ?>">Firmy</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Employer:default")) ?>">Zaměstnanci</a>
    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:default")) ?>">Menu</a>
</p>

<table border="1" width="100%">
    <tr>
        <th>Firma</th>
        <th>Minimální plat ve firmě</th>
        <th>Minimální plat ve firmě</th>
        <th>Průměrný plat ve firmě</th>
        <th>Celková plat ve firmě</th>
    </tr>
<?php
		$iterations = 0;
		foreach ($statistics as $s) {
?>
            <tr>
                <td><?php echo LR\Filters::escapeHtmlText($s['name']) /* line 22 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['min']) /* line 23 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['max']) /* line 24 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['avg']) /* line 25 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['sum']) /* line 26 */ ?></td>
            </tr>
<?php
			$iterations++;
		}
?>
    </div>
</table><?php
	}

}
