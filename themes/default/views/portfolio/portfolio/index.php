<?php
/* @var $this PortfolioController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = array('Портфолио', Yii::app()->getModule('yupe')->siteName);
$this->breadcrumbs = array('Портфолио');

?>
	<h1 class="page-header">Портфолио</h1>

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
			'firstPageCssClass' => 'hidden',
			'lastPageCssClass' => 'hidden',
			'prevPageLabel'       => '&laquo;',
			'nextPageLabel'        => '&raquo;',
			'hiddenPageCssClass'   => '',
		),
	)
); ?>