<?php

class m140121_192935_add_slug_index extends CDbMigration
{
	public function up()
	{
		$this->createIndex('slug', '{{portfolio}}', 'slug', true);
	}

	public function down()
	{
		$this->dropIndex('slug', '{{portfolio}}');
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