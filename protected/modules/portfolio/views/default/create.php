<?php
/**
 * Отображение для create:
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
        Yii::t('portfolio', 'Добавление'),
    );

    $this->pageTitle = Yii::t('portfolio', 'Портфолио - добавление');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t('portfolio', 'Управление портфолио'), 'url' => array('/portfolio/default/index')),
        array('icon' => 'plus-sign', 'label' => Yii::t('portfolio', 'Добавить портфолио'), 'url' => array('/portfolio/default/create')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('portfolio', 'Портфолио'); ?>
        <small><?php echo Yii::t('portfolio', 'добавление'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>