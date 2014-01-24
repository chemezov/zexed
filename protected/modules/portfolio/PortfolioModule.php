<?php

class PortfolioModule extends YWebModule
{
	public $uploadPath = 'portfolio';
	public $allowedExtensions = 'jpg,jpeg,png,gif';
	public $minSize = 0;
	public $maxSize;
	public $maxFiles = 1;

	public function getDependencies()
	{
		return array();
	}

	public function getUploadPath()
	{
		return Yii::getPathOfAlias('webroot') . '/' .
		Yii::app()->getModule('yupe')->uploadPath . '/' .
		$this->uploadPath . '/';
	}

	public function checkSelf()
	{
		$messages = array();

		$uploadPath = $this->getUploadPath();

		if (!is_writable($uploadPath)) {
			$messages[YWebModule::CHECK_ERROR][] = array(
				'type'    => YWebModule::CHECK_ERROR,
				'message' => Yii::t(
						'PortfolioModule.portfolio',
						'Директория "{dir}" не доступна для записи! {link}',
						array(
							'{dir}'  => $uploadPath,
							'{link}' => CHtml::link(
									Yii::t('PortfolioModule.portfolio', 'Изменить настройки'),
									array(
										'/yupe/backend/modulesettings/',
										'module' => 'portfolio',
									)
								),
						)
					),
			);
		}

		return isset($messages[YWebModule::CHECK_ERROR]) ? $messages : true;
	}

	public function getInstall()
	{
		if (parent::getInstall()) {
			@mkdir($this->getUploadPath(), 0755);
		}

		return false;
	}

	public function getEditableParams()
	{
		return array(
			'uploadPath',
			'adminMenuOrder',
			'editor' => Yii::app()->getModule('yupe')->editors,
			'allowedExtensions',
			'minSize',
			'maxSize',
		);
	}

	public function getParamsLabels()
	{
		return array(
			'adminMenuOrder'    => Yii::t('PortfolioModule.portfolio', 'Порядок следования в меню'),
			'uploadPath'        => Yii::t('PortfolioModule.portfolio', 'Каталог для загрузки файлов (относительно Yii::app()->getModule("yupe")->uploadPath)'),
			'editor'            => Yii::t('PortfolioModule.portfolio', 'Визуальный редактор'),
			'allowedExtensions' => Yii::t('PortfolioModule.portfolio', 'Разрешенные расширения (перечислите через запятую)'),
			'minSize'           => Yii::t('PortfolioModule.portfolio', 'Минимальный размер (в байтах)'),
			'maxSize'           => Yii::t('PortfolioModule.portfolio', 'Максимальный размер (в байтах)'),
		);
	}

	public function getNavigation()
	{
		return array(
			array('icon' => 'list-alt', 'label' => Yii::t('PortfolioModule.portfolio', 'Список портфолио'), 'url' => array('/portfolio/default/index')),
			array('icon' => 'plus-sign', 'label' => Yii::t('PortfolioModule.portfolio', 'Добавить портфолио'), 'url' => array('/portfolio/default/create')),
		);
	}

	public function getAdminPageLink()
	{
		return '/portfolio/default/index';
	}

	public function getVersion()
	{
		return Yii::t('PortfolioModule.portfolio', '0.1');
	}

	public function getCategory()
	{
		return Yii::t('PortfolioModule.portfolio', 'Контент');
	}

	public function getName()
	{
		return Yii::t('PortfolioModule.portfolio', 'Портфолио');
	}

	public function getDescription()
	{
		return Yii::t('PortfolioModule.portfolio', 'Модуль для создания каталога работ');
	}

	public function getAuthor()
	{
		return Yii::t('PortfolioModule.portfolio', 'Michael Chemezov');
	}

	public function getAuthorEmail()
	{
		return Yii::t('PortfolioModule.portfolio', 'michlenanosoft@gmail.com');
	}

	public function getUrl()
	{
		return Yii::t('PortfolioModule.portfolio', 'http://zexed.net');
	}

	public function getIcon()
	{
		return 'briefcase';
	}

	public function init()
	{
		parent::init();

		$this->setImport(
			array(
				'portfolio.models.*',
				'portfolio.components.*',
			)
		);
	}

	public function beforeControllerAction($controller, $action)
	{
		$this->editorOptions = CMap::mergeArray(
			array(
				'contentsCss' => Yii::app()->baseUrl . '/themes/default/web/css/result.css',
			),
			$this->editorOptions
		);

		return true;
	}
}
