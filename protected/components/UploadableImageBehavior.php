<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Michael
 * Date: 11.11.12
 * Time: 5:05
 * To change this template use File | Settings | File Templates.
 */

/* TODO: Make images name as md5 */
/* TODO: Реализовать возможность загрузки файлов в несколько полей модели */

class UploadableImageBehavior extends UploadableFileBehavior
{

	public $fileTypes = 'gif,jpg,jpeg,png';

	public $separator = ';';

	public $sizes = array(
		array(800, 200)
	);

	public $minSize = array(0, 0);

	public function beforeSave($event)
	{
		if ($file = CUploadedFile::getInstance($this->getOwner(), $this->attributeName))
		{
			$this->deleteFile(); // старый файл удалим, потому что загружаем новый

			if (!is_dir($this->getSavePath()))
				mkdir($this->getSavePath());

			/* @var $image CImage */
			$image = Yii::app()->image->load($file->tempName);

			$attributeValue = array();

			foreach ($this->sizes as $size)
			{
				if ($size !== 'original')
				{
					$image->smartResize($size[0], $size[1]);
				}

				$filename = $this->generateFilename($file, array('size' => $size));
				$image->quality(100)->save($this->getSavePath() . $filename);
				$attributeValue[] = $filename;
			}

			unset($image);

			$this->getOwner()->setAttribute($this->attributeName, implode($this->separator, $attributeValue));
			//$file->saveAs($this->getSavePath() . $file->getName());
		}
		return true;
	}

	public function getImageName($sizeId = 0)
	{
		$sizes = $this->getFiles();
		if (is_array($sizes) && !empty($sizes[$sizeId]))
			return $sizes[$sizeId];
		else
			return false;
	}

	public function getImageWidth($sizeId = 0)
	{
		return $this->sizes[$sizeId][0];
	}

	public function getImageHeight($sizeId = 0)
	{
		return $this->sizes[$sizeId][1];
	}

	public function beforeDelete($event)
	{
		$this->deleteFile(); // удалили модель? удаляем и файл от неё
	}

	public function getFiles()
	{
		if ($this->getOwner()->getAttribute($this->attributeName))
		{
			return explode($this->separator, $this->getOwner()->getAttribute($this->attributeName));
		}
		else
		{
			return false;
		}
	}

	public function deleteFile()
	{
		if ($this->getFiles())
		{
			foreach ($this->getFiles() as $file)
			{
				$filePath = $this->getSavePath() . $file;
				if (is_file($filePath))
				{
					unlink($filePath);
				}
			}
		}
	}

	/**
	 * Функция генерирует имя файла
	 *
	 * @param CUploadedFile $file
	 * @param array $params
	 */
	protected function generateFilename(CUploadedFile $file, $params)
	{

		$filename = rtrim($file->getName(), '.' . $file->getExtensionName());
		$filename = $this->getCorrectFilename($filename);

		if (isset($params['size']) && is_array($params['size']))
		{
			$filename .= '_' . $params['size'][0] . 'x' . $params['size'][1];
		}
		elseif (isset($params['size']))
		{
			$filename .= '_' . $params['size'];
		}

		$filename .= '.' . $file->getExtensionName();

		return $filename;
	}

	public function afterValidate($event)
	{
		if (($file = CUploadedFile::getInstance($this->getOwner(), $this->attributeName)) && is_array($this->minSize))
		{
			$size = getimagesize($file->tempName);
			if ($size[0] < $this->minSize[0] || $size[1] < $this->minSize[1])
			{
				$this->getOwner()->addError($this->attributeName, Yii::t('app', 'Too small image. Min size {width}x{height}', array('{width}' => $this->minSize[0], '{height}' => $this->minSize[1])));
				return false;
			}
		}
		return true;
	}
}