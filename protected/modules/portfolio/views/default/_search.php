<?php
/**
 * Отображение для _search:
 *
 *   @category YupeView
 *   @package  YupeCMS
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => array('class' => 'well'),
    )
);
?>

    <fieldset class="inline">
        <div class="row-fluid control-group">
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'id', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 60, 'data-original-title' => $model->getAttributeLabel('id'), 'data-content' => $model->getAttributeDescription('id'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'name', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 255, 'data-original-title' => $model->getAttributeLabel('name'), 'data-content' => $model->getAttributeDescription('name'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textAreaRow($model, 'short_description', array('class' => 'span5 popover-help', 'rows' => 6, 'cols' => 50, 'data-original-title' => $model->getAttributeLabel('short_description'), 'data-content' => $model->getAttributeDescription('short_description'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textAreaRow($model, 'description', array('class' => 'span5 popover-help', 'rows' => 6, 'cols' => 50, 'data-original-title' => $model->getAttributeLabel('description'), 'data-content' => $model->getAttributeDescription('description'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'image', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 255, 'data-original-title' => $model->getAttributeLabel('image'), 'data-content' => $model->getAttributeDescription('image'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'start_date', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 60, 'data-original-title' => $model->getAttributeLabel('start_date'), 'data-content' => $model->getAttributeDescription('start_date'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'end_date', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 60, 'data-original-title' => $model->getAttributeLabel('end_date'), 'data-content' => $model->getAttributeDescription('end_date'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'status', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 60, 'data-original-title' => $model->getAttributeLabel('status'), 'data-content' => $model->getAttributeDescription('status'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'seo_title', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 255, 'data-original-title' => $model->getAttributeLabel('seo_title'), 'data-content' => $model->getAttributeDescription('seo_title'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'seo_description', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 255, 'data-original-title' => $model->getAttributeLabel('seo_description'), 'data-content' => $model->getAttributeDescription('seo_description'))); ?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'seo_keywords', array('class' => 'span3 popover-help', 'size' => 60, 'maxlength' => 255, 'data-original-title' => $model->getAttributeLabel('seo_keywords'), 'data-content' => $model->getAttributeDescription('seo_keywords'))); ?>
            </div>
        </div>
    </fieldset>

    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'type'        => 'primary',
            'encodeLabel' => false,
            'buttonType'  => 'submit',
            'label'       => '<i class="icon-search icon-white">&nbsp;</i> ' . Yii::t('portfolio', 'Искать портфолио'),
        )
    ); ?>

<?php $this->endWidget(); ?>