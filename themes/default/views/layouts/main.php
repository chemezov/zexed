<?php
/**
 * Шаблон для layout/main:
 *
 * @category YupeLayout
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>" xmlns="http://www.w3.org/1999/html">
<head>
	<?php Yii::app()->controller->widget(
		'ext.seo.widgets.SeoHead',
		array(
			'httpEquivs'         => array(
				'Content-Type'     => 'text/html; charset=utf-8',
				'X-UA-Compatible'  => 'IE=edge,chrome=1',
				'Content-Language' => 'ru-RU'
			),
			'defaultTitle'       => Yii::app()->getModule('yupe')->siteName,
			'defaultDescription' => Yii::app()->getModule('yupe')->siteDescription,
			'defaultKeywords'    => Yii::app()->getModule('yupe')->siteKeyWords,
		)
	); ?>

	<link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico" />

	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/web/css/result.css'); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/web/js/vendor/modernizr-2.6.2.min.js'); ?>

	<?php Yii::app()->clientScript->registerPackage('jquery', CClientScript::POS_END); ?>
	<? /* @TODO: <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script> */ ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/web/js/plugins.js'); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/web/js/main.js'); ?>
</head>
<body>
<div class="page-wrapper">
	<!--[if lt IE 7]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please
		<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

	<div class="container">

		<div class="masthead">
			<h3 class="muted"><?= Yii::app()->getModule('yupe')->siteName ?></h3>

			<?php
			$this->widget(
				'application.modules.menu.widgets.MenuWidget',
				array(
					'name'         => 'top-menu',
					'params'       => array(
						'hideEmptyItems' => true,
						'htmlOptions'    => array()
					),
					'layoutParams' => array(),
				)
			); ?>
		</div>

		<?php $this->widget('YFlashMessages'); ?>

		<?php echo $content; ?>
	</div>
	<div id="push"></div>
</div>

<div class="footer">
	<div class="container">
		<span class="muted"><?php $this->widget('application.modules.contentblock.widgets.ContentBlockWidget', array('code' => 'copyright')) ?></span>

		<div class="pull-right">
			<?php $this->widget('YPerformanceStatistic'); ?>
		</div>
		<?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", array("code" => "STAT", "silent" => true)); ?>
	</div>
</div>
</body>
</html>