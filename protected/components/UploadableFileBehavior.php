<?php

/**
 * @property string $savePath путь к директории, в которой сохраняем файлы
 */
class UploadableFileBehavior extends CActiveRecordBehavior
{
	/**
	 * @var string название атрибута, хранящего в себе имя файла и файл
	 */
	public $attributeName = 'document';
	/**
	 * @var string алиас директории, куда будем сохранять файлы
	 */
	public $savePathAlias = 'webroot.upload';

	public $savePath = null;
	/**
	 * @var array сценарии валидации к которым будут добавлены правила валидации
	 * загрузки файлов
	 */
	public $scenarios = array('create', 'update');
	/**
	 * @var string типы файлов, которые можно загружать (нужно для валидации)
	 */
	public $fileTypes = 'doc,docx,xls,xlsx,odt,pdf';

	/**
	 * Шорткат для Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR.
	 * Возвращает путь к директории, в которой будут сохраняться файлы.
	 * @return string путь к директории, в которой сохраняем файлы
	 */
	public function getSavePath()
	{
		return (!empty($this->savePath)) ? $this->savePath : Yii::getPathOfAlias($this->savePathAlias) . DIRECTORY_SEPARATOR;
	}

	public function attach($owner)
	{
		parent::attach($owner);

		if (in_array($owner->getScenario(), $this->scenarios))
		{
// добавляем валидатор файла, не забываем в параметрах валидатора указать
// значение safe как false
			$fileValidator = CValidator::createValidator(
				'file',
				$owner,
				$this->attributeName,
				array(
					'types'      => $this->fileTypes,
					'allowEmpty' => true,
					'safe'       => false,
				)
			);
			$owner->validatorList->add($fileValidator);
		}
	}

	public function beforeSave($event)
	{
		if ($file = CUploadedFile::getInstance($this->getOwner(), $this->attributeName))
		{
			$this->deleteFile(); // старый файл удалим, потому что загружаем новый

			$this->getOwner()->setAttribute($this->attributeName, $file->getName());

			if (!is_dir($this->getSavePath()))
			{
				mkdir($this->getSavePath());
			}
			$file->saveAs($this->getSavePath() . $file->getName());
		}
		return true;
	}

	public function beforeDelete($event)
	{
		$this->deleteFile(); // удалили модель? удаляем и файл от неё
	}

	public function deleteFile()
	{
		$filePath = $this->getSavePath() . $this->getOwner()->getAttribute($this->attributeName);
		if (is_file($filePath))
			unlink($filePath);
	}

	public function getCorrectFilename($filename)
	{
		Yii::import('ext.UrlTransliterate.UrlTransliterate');
		return str_replace(array(" ", "[", "]"), "_", strtolower(strtr($filename, UrlTransliterate::i18nToAscII())));
	}
}

?>