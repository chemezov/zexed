<?php
/* @var $this PortfolioController */
/* @var $model Portfolio */

$this->pageTitle = array($model->seo_title ? $model->seo_title : $model->name, 'Портфолио', Yii::app()->getModule('yupe')->siteName);
$this->metaKeywords = ($model->seo_keywords) ? $model->seo_keywords : $model->name;
$this->metaDescription = ($model->seo_description) ? $model->seo_description : $model->name;

$this->breadcrumbs = array(
	Yii::t('PortfolioModule.portfolio', 'Портфолио') => array('/portfolio/portfolio/index'),
	$model->name
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/web/vendor/bootstrap/js/bootstrap.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerPackage('fancybox');
?>

<h1 class="page-header"><?= $model->name ?></h1>

<div class="portfolio-view">
	<div class="row-fluid">
		<div class="span6">
			<p class="date muted"><?= $model->date ?></p>
		</div>
		<div class="span6">
			<div class="text-right">
				<?php if (!empty($model->link)): ?>
					<a class="btn btn-success" href="<?= $model->link ?>" target="_blank"><?= $model->link ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="preview">
		<?= $model->short_description ?>
	</div>

	<?php if ($model->image): ?>
		<a href="<?= $model->getImageUrl() ?>" class="fancybox.image"> <img class="img-polaroid" src="<?=
			$model->getImageUrl(
				2
			) ?>" alt="<?= $model->name ?>" width="990" /> </a>
	<?php endif; ?>

	<div class="description"><?= $model->description ?></div>

	<div class="technology">
		<strong class="show">Используемые технологии:</strong>

		<?php if (!empty($model->tags)): ?>
			<div class="row-fluid">
				<?php foreach ($model->tags as $tag): ?>
					<a class="label" href="<?= $tag->url ?>" data-toggle="tooltip" title="<?= $tag->name ?>"><?= $tag->name ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php Yii::app()->clientScript->registerScript('technology', '$(".technology a").tooltip();', CClientScript::POS_END); ?>
</div>