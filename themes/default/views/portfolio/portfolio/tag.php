<?php
/* @var $this PortfolioController */
/* @var $dataProvider CActiveDataProvider */
/* @var $tag string */

$this->pageTitle = array($tag, 'Портфолио', Yii::app()->getModule('yupe')->siteName);
$this->breadcrumbs = array(
	'Портфолио' => array('/portfolio/portfolio/index'),
	$tag
);

?>
	<h1 class="page-header">Портфолио с использованием <?= $tag ?></h1>

<?php $this->widget(
	'zii.widgets.CListView',
	array(
		'dataProvider'  => $dataProvider,
		'itemView'      => '_view',
		'itemsTagName'  => 'ul',
		'itemsCssClass' => 'portfolio-list unstyled',
		'template'      => '{items}{pager}',
		'cssFile'       => false,
		'pagerCssClass' => 'pagination',
		'pager'         => array(
			'cssFile'              => false,
			'header'               => false,
			'selectedPageCssClass' => 'active',
			'firstPageCssClass'    => 'hidden',
			'lastPageCssClass'     => 'hidden',
			'prevPageLabel'        => '&laquo;',
			'nextPageLabel'        => '&raquo;',
			'hiddenPageCssClass'   => '',
		),
	)
); ?>