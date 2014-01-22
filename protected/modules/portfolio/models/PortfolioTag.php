<?php

/**
 * This is the model class for table "{{portfolio_tag}}".
 *
 * The followings are the available columns in table '{{portfolio_tag}}':
 * @property integer $id
 * @property string $name
 */
class PortfolioTag extends YModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PortfolioTag the static model class
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
		return '{{portfolio_tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max' => 255),
			array('name', 'match', 'pattern' => '/^[\w\sА-Яа-яёЁ"]+/', 'message' => 'В тэгах можно использовать только буквы, цифры и запятые.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on' => 'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Return tag model by string
	 * @param string $tag_name
	 * @param bool $create
	 * @return Tag|null
	 */
	public static function getTagByName($tag_name, $create = false)
	{
		$tag = PortfolioTag::model()->find(
			'LOWER(name) = :name',
			array(
				':name' => mb_strtolower($tag_name, Yii::app()->charset),
			)
		);

		if ($tag === null && $create) {
			$tag = new PortfolioTag();
			$tag->name = stripcslashes($tag_name);
			$tag->save();
		}

		return $tag;
	}

	public function getUrl()
	{
		return Yii::app()->createUrl(
			'/portfolio/portfolio/tag',
			array('tag' => function_exists('mb_strtolower') ? mb_strtolower($this->name, Yii::app()->charset) : strtolower($this->name))
		);
	}

	public static function removeEmptyTags()
	{
		$command = Yii::app()->db->createCommand(
			'SELECT t.id FROM {{portfolio_tag}} t LEFT JOIN {{portfolio_portfolio_tag}} pt ON pt.tag_id = t.id WHERE ISNULL(pt.portfolio_id) GROUP BY t.id'
		);

		$tags = $command->queryColumn();

		$criteria = PortfolioTag::model()->getDbCriteria();

		$criteria->addInCondition('id', $tags);

		return PortfolioTag::model()->deleteAll($criteria);
	}

	public static function getAllTags()
	{
		$command = Yii::app()->db->createCommand('SELECT name FROM {{portfolio_tag}}');

		return $command->queryColumn();
	}
}