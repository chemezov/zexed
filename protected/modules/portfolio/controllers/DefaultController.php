<?php
/**
 * Класс DefaultController:
 *
 *   @category YupeYBackController
 *   @package  YupeCMS
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
class DefaultController extends YBackController
{
    /**
     * Отображает портфолио по указанному идентификатору
     *
     * @param integer $id Идинтификатор портфолио для отображения
     *
     * @return nothing
     */
    public function actionView($id)
    {
        $this->render('view', array('model' => $this->loadModel($id)));
    }

    /**
     * Создает новую модель портфолио.
     * Если создание прошло успешно - перенаправляет на просмотр.
     *
     * @return nothing
     */
    public function actionCreate()
    {
        $model = new Portfolio;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Portfolio'])) {
            $model->attributes = $_POST['Portfolio'];

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    YFlashMessages::NOTICE_MESSAGE,
                    Yii::t('portfolio', 'Запись добавлена!')
                );

                if (!isset($_POST['submit-type']))
                    $this->redirect(array('update', 'id' => $model->id));
                else
                    $this->redirect(array($_POST['submit-type']));
            }
        }
        $this->render('create', array('model' => $model));
    }

    /**
     * Редактирование портфолио.
     *
     * @param integer $id Идинтификатор портфолио для редактирования
     *
     * @return nothing
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Portfolio'])) {
            $model->attributes = $_POST['Portfolio'];

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    YFlashMessages::NOTICE_MESSAGE,
                    Yii::t('portfolio', 'Запись обновлена!')
                );

                if (!isset($_POST['submit-type']))
                    $this->redirect(array('update', 'id' => $model->id));
                else
                    $this->redirect(array($_POST['submit-type']));
            }
        }
        $this->render('update', array('model' => $model));
    }

    /**
     * Удаляет модель портфолио из базы.
     * Если удаление прошло успешно - возвращется в index
     *
     * @param integer $id идентификатор портфолио, который нужно удалить
     *
     * @return nothing
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                YFlashMessages::NOTICE_MESSAGE,
                Yii::t('portfolio', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, Yii::t('portfolio', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }

    /**
     * Управление портфолио.
     *
     * @return nothing
     */
    public function actionIndex()
    {
        $model = new Portfolio('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Portfolio']))
            $model->attributes = $_GET['Portfolio'];
        $this->render('index', array('model' => $model));
    }

    /**
     * Возвращает модель по указанному идентификатору
     * Если модель не будет найдена - возникнет HTTP-исключение.
     *
     * @param integer идентификатор нужной модели
     *
     * @return nothing
     */
    public function loadModel($id)
    {
        $model = Portfolio::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('portfolio', 'Запрошенная страница не найдена.'));
        return $model;
    }

    /**
     * Производит AJAX-валидацию
     *
     * @param CModel модель, которую необходимо валидировать
     *
     * @return nothing
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'portfolio-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
