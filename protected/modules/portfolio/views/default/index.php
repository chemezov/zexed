<?php
/**
 * Отображение для index:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$this->breadcrumbs = array(
	Yii::app()->getModule('portfolio')->getCategory() => array(),
	Yii::t('portfolio', 'Портфолио')                  => array('/portfolio/default/index'),
	Yii::t('portfolio', 'Управление'),
);

$this->pageTitle = Yii::t('portfolio', 'Портфолио - управление');

$this->menu = array(
	array('icon' => 'list-alt', 'label' => Yii::t('portfolio', 'Управление портфолио'), 'url' => array('/portfolio/default/index')),
	array('icon' => 'plus-sign', 'label' => Yii::t('portfolio', 'Добавить портфолио'), 'url' => array('/portfolio/default/create')),
);
?>
<div class="page-header">
	<h1>
		<?php echo Yii::t('portfolio', 'Портфолио'); ?>
		<small><?php echo Yii::t('portfolio', 'управление'); ?></small>
	</h1>
</div>

<p> <?php echo Yii::t('portfolio', 'В данном разделе представлены средства управления портфолио'); ?>
</p>

<?php
$this->widget(
	'application.modules.yupe.components.YCustomGridView',
	array(
		'id'           => 'portfolio-grid',
		'type'         => 'condensed',
		'dataProvider' => $model->search(),
		'filter'       => $model,
		'columns'      => array(
			'id',
			'name',
			array(
				'name'  => 'image',
				'type'  => 'raw',
				'value' => 'CHtml::image($data->getImageUrl(3), $data->name)',
			),
			'start_date',
			'end_date',
			array(
				'name'  => 'status',
				'value' => '$data->getStatus()',
			),
			/*'seo_title',
			'seo_description',
			'seo_keywords',
			*/
			array(
				'class' => 'bootstrap.widgets.TbButtonColumn',
			),
		),
	)
); ?>
