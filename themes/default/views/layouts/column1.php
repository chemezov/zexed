<?php $this->beginContent('//layouts/main'); ?>
<?php $this->widget(
	'bootstrap.widgets.TbBreadcrumbs',
	array(
		'links' => $this->breadcrumbs,
	)
);
?><!-- breadcrumbs -->

<?php echo $content; ?>
<?php $this->endContent(); ?>
