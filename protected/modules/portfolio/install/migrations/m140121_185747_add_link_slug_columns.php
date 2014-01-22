<?php

class m140121_185747_add_link_slug_columns extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{portfolio}}', 'link', 'string');
		$this->addColumn('{{portfolio}}', 'slug', 'string');
	}

	public function down()
	{
		$this->dropColumn('{{portfolio}}', 'link');
		$this->dropColumn('{{portfolio}}', 'slug');
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