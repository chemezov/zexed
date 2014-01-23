<?php

class m140123_223738_add_sort extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{image_image}}', 'sort', "integer NOT NULL DEFAULT '1'");

		Yii::app()->db->createCommand('UPDATE {{image_image}} SET sort = id')->execute();

		$this->createIndex('sort', '{{image_image}}', 'sort');
	}

	public function down()
	{
		$this->dropColumn('{{image_image}}', 'sort');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}