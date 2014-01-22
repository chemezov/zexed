<script type='text/javascript'>
	$(document).ready(function () {
		$('#portfolio-form').liTranslit({
			elName: '#Portfolio_name',
			elAlias: '#Portfolio_slug'
		});
	})
</script>

<?php
/**
 * Отображение для _form:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/

/* @var $form TbActiveForm */
/* @var $model Portfolio */
$form = $this->beginWidget(
	'bootstrap.widgets.TbActiveForm',
	array(
		'id'                     => 'portfolio-form',
		'enableAjaxValidation'   => false,
		'enableClientValidation' => true,
		'type'                   => 'vertical',
		'htmlOptions'            => array('class' => 'well', 'enctype' => 'multipart/form-data'),
		'inlineErrors'           => true,
	)
);
?>

<div class="alert alert-info">
	<?php echo Yii::t('portfolio', 'Поля, отмеченные'); ?>
	<span class="required">*</span>
	<?php echo Yii::t('portfolio', 'обязательны.'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid control-group <?php echo $model->hasErrors('name') ? 'error' : ''; ?>">
	<?php echo $form->textFieldRow(
		$model,
		'name',
		array(
			'class'               => 'span12 popover-help',
			'size'                => 60,
			'maxlength'           => 255,
			'data-original-title' => $model->getAttributeLabel('name'),
			'data-content'        => $model->getAttributeDescription('name')
		)
	); ?>
</div>
<div class="row-fluid control-group <?php echo $model->hasErrors('slug') ? 'error' : ''; ?>">
	<?php echo $form->textFieldRow(
		$model,
		'slug',
		array(
			'size'                => 60,
			'maxlength'           => 150,
			'placeholder'         => Yii::t('PortfolioModule.portfolio', 'Оставьте пустым для автоматической генерации'),
			'class'               => 'span7 popover-help',
			'data-original-title' => $model->getAttributeLabel('slug'),
			'data-content'        => $model->getAttributeDescription('slug')
		)
	); ?>
</div>
<div class="row-fluid control-group <?php echo $model->hasErrors('link') ? 'error' : ''; ?>">
	<?php echo $form->textFieldRow(
		$model,
		'link',
		array(
			'class'               => 'span12 popover-help',
			'size'                => 60,
			'maxlength'           => 255,
			'data-original-title' => $model->getAttributeLabel('link'),
			'data-content'        => $model->getAttributeDescription('link')
		)
	); ?>
</div>
<div class="row-fluid control-group <?php echo $model->hasErrors('short_description') ? 'error' : ''; ?>">
	<div class="popover-help" data-original-title='<?php echo $model->getAttributeLabel(
		'short_description'
	); ?>' data-content='<?php echo $model->getAttributeDescription('short_description'); ?>'>
		<?php echo $form->labelEx($model, 'short_description'); ?>
		<?php $this->widget(
			$this->module->editor,
			array(
				'model'     => $model,
				'attribute' => 'short_description',
				'options'   => $this->module->editorOptions,
			)
		); ?>
	</div>
</div>
<div class="row-fluid control-group <?php echo $model->hasErrors('description') ? 'error' : ''; ?>">
	<div class="popover-help" data-original-title='<?php echo $model->getAttributeLabel(
		'description'
	); ?>' data-content='<?php echo $model->getAttributeDescription('description'); ?>'>
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php $this->widget(
			$this->module->editor,
			array(
				'model'     => $model,
				'attribute' => 'description',
				'options'   => $this->module->editorOptions,
			)
		); ?>
	</div>
</div>
<div class="row-fluid control-group <?php echo $model->hasErrors('image') ? 'error' : ''; ?>">
	<div class="span7  popover-help" data-original-title="<?php echo $model->getAttributeLabel('image'); ?>">
		<?php echo $form->labelEx($model, 'image'); ?>
		<?php if (!$model->isNewRecord && $model->image): ?>
			<?php echo CHtml::image($model->getImageUrl(2), $model->name, array('width' => 300)); ?>
		<?php endif; ?>
		<div class="row-fluid">
			<?php echo $form->fileField($model, 'image'); ?>
		</div>
	</div>
	<div class="span5">
		<?php echo $form->error($model, 'image'); ?>
	</div>
</div>
<div class="row-fluid control-group">
	<div class="span4">
		<?php echo $form->dropDownListRow($model, 'status', $model->getStatusList(), array('class' => 'span12 popover-help')); ?>
	</div>
	<div class="span4">
		<?php echo $form->datepickerRow(
			$model,
			'start_date',
			array(
				'prepend'             => '<i class="icon-calendar"></i>',
				'class'               => 'span11 popover-help',
				'size'                => 60,
				'maxlength'           => 60,
				'data-original-title' => $model->getAttributeLabel('start_date'),
				'data-content'        => $model->getAttributeDescription('start_date'),
				'options'             => array(
					'language'           => 'ru',
					'format'             => 'dd.mm.yyyy',
					'autoclose'          => 'true',
					'weekStart'          => 1,
					'keyboardNavigation' => true
				),
			)
		); ?>
	</div>
	<div class="span4">
		<?php echo $form->datepickerRow(
			$model,
			'end_date',
			array(
				'prepend'             => '<i class="icon-calendar"></i>',
				'class'               => 'span11 popover-help',
				'size'                => 60,
				'maxlength'           => 60,
				'data-original-title' => $model->getAttributeLabel('end_date'),
				'data-content'        => $model->getAttributeDescription('end_date'),
				'options'             => array(
					'language'           => 'ru',
					'format'             => 'dd.mm.yyyy',
					'autoclose'          => 'true',
					'weekStart'          => 1,
					'keyboardNavigation' => true
				),
			)
		); ?>
	</div>
</div>

<div class="row-fluid">
	<?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); ?>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				<?php echo Yii::t('PortfolioModule.portfolio', 'Данные для SEO'); ?>
			</a>
		</div>
		<div id="collapseOne" class="accordion-body collapse">
			<div class="accordion-inner">
				<div class="row-fluid control-group <?php echo $model->hasErrors('seo_title') ? 'error' : ''; ?>">
					<?php echo $form->textFieldRow(
						$model,
						'seo_title',
						array(
							'size'                => 60,
							'maxlength'           => 255,
							'class'               => 'span7 popover-help',
							'data-original-title' => $model->getAttributeLabel('seo_title'),
							'data-content'        => $model->getAttributeDescription('seo_title')
						)
					); ?>
				</div>
				<div class="row-fluid control-group <?php echo $model->hasErrors('seo_keywords') ? 'error' : ''; ?>">
					<?php echo $form->textFieldRow(
						$model,
						'seo_keywords',
						array(
							'size'                => 60,
							'maxlength'           => 255,
							'class'               => 'span7 popover-help',
							'data-original-title' => $model->getAttributeLabel('seo_keywords'),
							'data-content'        => $model->getAttributeDescription('seo_keywords')
						)
					); ?>
				</div>
				<div class="row-fluid control-group <?php echo $model->hasErrors('seo_description') ? 'error' : ''; ?>">
					<?php echo $form->textAreaRow(
						$model,
						'seo_description',
						array(
							'rows'                => 3,
							'cols'                => 98,
							'class'               => 'span7 popover-help',
							'data-original-title' => $model->getAttributeLabel('seo_description'),
							'data-content'        => $model->getAttributeDescription('seo_description')
						)
					); ?>
				</div>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php
$this->widget(
	'bootstrap.widgets.TbButton',
	array(
		'buttonType' => 'submit',
		'type'       => 'primary',
		'label'      => Yii::t('portfolio', 'Сохранить портфолио и закрыть'),
	)
); ?>

<?php
$this->widget(
	'bootstrap.widgets.TbButton',
	array(
		'buttonType'  => 'submit',
		'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
		'label'       => Yii::t('portfolio', 'Сохранить портфолио и продолжить'),
	)
); ?>

<?php $this->endWidget(); ?>