<?php

class m140120_193951_create_portfolio_table extends CDbMigration
{
	public function up()
	{
		$this->createTable(
			'{{portfolio}}',
			array(
				'id'                => 'pk',
				'name'              => 'string',
				'short_description' => 'text',
				'description'       => 'text',
				'image'             => 'string',
				'start_date'        => 'date NOT NULL',
				'end_date'          => 'date',
				'status'            => 'tinyint(1) NOT NULL DEFAULT 1',
				'seo_title'         => 'string',
				'seo_description'   => 'string',
				'seo_keywords'      => 'string',
			)
		);

		$this->createIndex('start_date', '{{portfolio}}', 'start_date');
		$this->createIndex('end_date', '{{portfolio}}', 'end_date');
		$this->createIndex('status', '{{portfolio}}', 'status');
	}

	public function down()
	{
		$this->dropTable('{{portfolio}}');
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