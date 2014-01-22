<?php

/**
 * This is the model class for table "{{portfolio}}".
 *
 * The followings are the available columns in table '{{portfolio}}':
 * @property integer $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $image
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $link
 * @property string $slug
 *
 * @property string $url
 *
 * @method Portfolio published()
 */
class Portfolio extends YModel
{
	const STATUS_HIDDEN = 1;
	const STATUS_PLANING = 2;
	const STATUS_DESIGN = 3;
	const STATUS_HTML = 4;
	const STATUS_DEVELOPMENT = 5;
	const STATUS_PUBLISHED = 6;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Portfolio the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{portfolio}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, status, slug', 'required'),
			array('status', 'numerical', 'integerOnly' => true),
			array('name, image, seo_title, seo_description, seo_keywords', 'length', 'max' => 255),
			array('slug, link', 'length', 'max' => 150),
			array('slug', 'unique', 'caseSensitive' => false),
			array('slug', 'YSLugValidator'),
			array('short_description, description, end_date', 'safe'),
			array('name, slug, link', 'filter', 'filter' => 'trim'),
			array('name, slug', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
			array('link', 'url'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, name, short_description, description, image, start_date, end_date, status, seo_title, seo_description, seo_keywords, link, slug',
				'safe',
				'on' => 'search'
			),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	public function defaultScope()
	{
		return array(
			'order' => $this->getTableAlias(false, false) . '.start_date DESC',
		);
	}

	public function scopes()
	{
		return array(
			'published' => array(
				'condition' => 'status != :status',
				'params'    => array(':status' => self::STATUS_HIDDEN),
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                => 'ID',
			'name'              => 'Название',
			'short_description' => 'Короткое описание',
			'description'       => 'Полное описание',
			'image'             => 'Изображение',
			'start_date'        => 'Дата начала',
			'end_date'          => 'Дата конца',
			'status'            => 'Статус',
			'slug'              => 'URL',
			'link'              => 'Ссылка',
			'seo_title'         => 'SEO: Заголовок',
			'seo_description'   => 'SEO: Описание',
			'seo_keywords'      => 'SEO: Ключевые слова',
		);
	}

	public function attributeDescriptions()
	{
		return array(
			'slug' => Yii::t(
					'PortfolioModule.portfolio',
					"Краткое название страницы латинскими буквами, используется для формирования её адреса.<br /><br /> Например (выделено темным фоном): <pre>http://site.ru/portfolio/<span class='label'>mysite</span>/</pre> Если вы не знаете, для чего вам нужно это поле &ndash; не заполняйте его, заголовка страницы будет достаточно."
				),
		);
	}

	public function behaviors()
	{
		$module = Yii::app()->getModule('portfolio');
		return array(
			'uploadableFile' => array(
				'class'         => 'application.components.UploadableImageBehavior',
				'attributeName' => 'image',
				'savePath'      => $module->getUploadPath(),
				'minSize'       => array(990, 400),
				'sizes'         => array(
					'original',
					array(1000, 400),
					array(990, 400),
					array(375, 150),
				)
			),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('short_description', $this->short_description, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('start_date', $this->start_date, true);
		$criteria->compare('end_date', $this->end_date, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('seo_title', $this->seo_title, true);
		$criteria->compare('seo_description', $this->seo_description, true);
		$criteria->compare('seo_keywords', $this->seo_keywords, true);
		$criteria->compare('link', $this->link, true);
		$criteria->compare('slug', $this->slug, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getStatusList()
	{
		return array(
			self::STATUS_HIDDEN      => 'Скрыт',
			self::STATUS_PLANING     => 'Планирование',
			self::STATUS_DESIGN      => 'Дизайн',
			self::STATUS_HTML        => 'Вёрстка',
			self::STATUS_DEVELOPMENT => 'В разработке',
			self::STATUS_PUBLISHED   => 'Завершён',
		);
	}

	public function getStatus()
	{
		$data = $this->getStatusList();
		return isset($data[$this->status]) ? $data[$this->status] : Yii::t('PortfolioModule.portfolio', '*неизвестно*');
	}

	public function beforeValidate()
	{
		if (!$this->slug) {
			$this->slug = YText::translit($this->name);
		}
		return parent::beforeValidate();
	}

	protected function beforeSave()
	{
		$this->start_date = date('Y-m-d', strtotime($this->start_date));
		$this->end_date = (!empty($this->end_date)) ? date('Y-m-d', strtotime($this->end_date)) : null;

		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();

		$this->start_date = date('d.m.Y', strtotime($this->start_date));
		if ($this->end_date) {
			$this->end_date = date('d.m.Y', strtotime($this->end_date));
		}
	}

	public function getImageUrl($size_id = 0)
	{
		return ($this->image)
			? Yii::app()->baseUrl . '/' .
			Yii::app()->getModule('yupe')->uploadPath . '/' .
			Yii::app()->getModule('portfolio')->uploadPath . '/' .
			$this->getImageName($size_id)
			: false;
	}

	public function getUrl()
	{
		return Yii::app()->createUrl('/portfolio/portfolio/view', array('slug' => $this->slug));
	}

	public function getDate()
	{
		if (!empty($this->end_date)) {
			$start_date_year = date('Y', strtotime($this->start_date));
			$end_date_year = date('Y', strtotime($this->end_date));
			$start_date_month = date('m', strtotime($this->start_date));
			$end_date_month = date('m', strtotime($this->end_date));

			if ($start_date_year == $end_date_year) {
				if ($start_date_month == $end_date_month) {
					return mb_strtolower(Yii::app()->dateFormatter->format('LLLL yyyy г.', $this->start_date), Yii::app()->charset);
				}

				return mb_strtolower(
					Yii::app()->dateFormatter->format('LLLL', $this->start_date) . ' — ' . Yii::app()->dateFormatter->format('LLLL yyyy г.', $this->end_date),
					Yii::app()->charset
				);
			}

			return mb_strtolower(
				Yii::app()->dateFormatter->format('LLLL yyyy г.', $this->start_date) . ' — ' . Yii::app()->dateFormatter->format(
					'LLLL yyyy г.',
					$this->end_date
				),
				Yii::app()->charset
			);
		} else {
			return mb_strtolower(Yii::app()->dateFormatter->format('LLLL yyyy г.', $this->start_date), Yii::app()->charset);
		}
	}
}