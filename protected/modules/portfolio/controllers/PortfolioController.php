<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 21.01.14
 * Time: 22:55
 */
class PortfolioController extends YFrontController
{
	const PAGE_SIZE = 10;

	public function behaviors()
	{
		return array(
			'seo' => array('class' => 'ext.seo.components.SeoControllerBehavior'),
		);
	}

	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider(Portfolio::model()->published(), array(
			'pagination' => array(
				'pageSize' => self::PAGE_SIZE,
			),
		));

		$this->render('index', array('dataProvider' => $dataProvider));
	}

	public function actionView($slug)
	{
		$model = $this->loadModelBySlug($slug);

		preg_match_all('/{gallery_(\d)}/', $model->description, $matches);

		if (count($matches[0]) > 0) {
			foreach ($matches[1] as $key => $gallery_id) {
				$model->description = str_replace($matches[0][$key], $this->renderGallery($gallery_id), $model->description);
			}
		}


		$this->render('view', array('model' => $model));
	}

	/**
	 * @param $id
	 * @return Portfolio
	 * @throws CHttpException
	 */
	protected function loadModel($id)
	{
		$model = Portfolio::model()->findByPk($id);

		if (!$model) {
			throw new CHttpException(404, Yii::t('PortfolioModule.portfolio', 'Портфолио не найдено!'));
		}

		return $model;
	}

	/**
	 * @param $id
	 * @return Portfolio
	 * @throws CHttpException
	 */
	protected function loadModelBySlug($slug)
	{
		$model = Portfolio::model()->findByAttributes(array('slug' => $slug));

		if (!$model) {
			throw new CHttpException(404, Yii::t('PortfolioModule.portfolio', 'Портфолио не найдено!'));
		}

		return $model;
	}

	public function renderGallery($id)
	{
		$model = Gallery::model()->findByPk($id);

		if (!$model) {
			return false;
		}

		return $this->renderPartial('_gallery', array('model' => $model), true);
	}

	public function actionTag($tag)
	{
		/* Переадресовываем, если не в нижнем регистре */
		if ($tag !== mb_strtolower($tag, Yii::app()->charset)) {
			Yii::app()->request->redirect(
				Yii::app()->createUrl('/portfolio/portfolio/tag', array('tag' => mb_strtolower($tag, Yii::app()->charset))),
				true,
				301
			);
		}

		$dataProvider = new CActiveDataProvider(Portfolio::model()->published()->tag($tag), array(
			'pagination' => array(
				'pageSize' => self::PAGE_SIZE,
			),
		));

		$this->render('tag', array('dataProvider' => $dataProvider, 'tag' => $tag));
	}
}