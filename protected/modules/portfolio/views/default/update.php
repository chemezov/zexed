<?php
/**
 * Отображение для update:
 *
 *   @category YupeView
 *   @package  YupeCMS
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
    $this->breadcrumbs = array(
        Yii::app()->getModule('portfolio')->getCategory() => array(),
        Yii::t('portfolio', 'Портфолио') => array('/portfolio/default/index'),
        $model->name => array('/portfolio/default/view', 'id' => $model->id),
        Yii::t('portfolio', 'Редактирование'),
    );

    $this->pageTitle = Yii::t('portfolio', 'Портфолио - редактирование');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t('portfolio', 'Управление портфолио'), 'url' => array('/portfolio/default/index')),
        array('icon' => 'plus-sign', 'label' => Yii::t('portfolio', 'Добавить портфолио'), 'url' => array('/portfolio/default/create')),
        array('label' => Yii::t('portfolio', 'Портфолио') . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('portfolio', 'Редактирование портфолио'), 'url' => array(
            '/portfolio/default/update',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('portfolio', 'Просмотреть портфолио'), 'url' => array(
            '/portfolio/default/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('portfolio', 'Удалить портфолио'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/portfolio/default/delete', 'id' => $model->id),
            'confirm' => Yii::t('portfolio', 'Вы уверены, что хотите удалить портфолио?'),
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('portfolio', 'Редактирование') . ' ' . Yii::t('portfolio', 'портфолио'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>