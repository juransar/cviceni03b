<?php
// source: C:\xampp\htdocs\cviceni03b\app\presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Template3db98dcc00 extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
	];

	public $blockTypes = [
		'css' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>BI-ZNF</title>

		<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>
	</head>

	<body>
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>		<div<?php if ($_tmp = array_filter(['flash', $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><?php
			echo LR\Filters::escapeHtmlText($flash->message) /* line 14 */ ?></div>
<?php
			$iterations++;
		}
?>

<?php
		$this->renderBlock('content', $this->params, 'html');
?>
	</body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 14');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockCss($_args)
	{
		extract($_args);
		?>		<link href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 9 */ ?>/css/screen.css" rel="stylesheet" type="text/css">
<?php
	}

}
