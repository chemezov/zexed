<?php

class m140122_150531_add_portfolio_tags extends CDbMigration
{
	public function up()
	{
		$this->createTable(
			'{{portfolio_tag}}',
			array(
				'id'   => 'pk',
				'name' => 'string NOT NULL',
			)
		);

		$this->createTable(
			'{{portfolio_portfolio_tag}}',
			array(
				'portfolio_id' => 'integer NOT NULL',
				'tag_id'       => 'integer NOT NULL',
			)
		);

		$this->createIndex('portfolio_id', '{{portfolio_portfolio_tag}}', 'portfolio_id');
		$this->createIndex('tag_id', '{{portfolio_portfolio_tag}}', 'tag_id');
	}

	public function down()
	{
		$this->dropTable('{{portfolio_tag}}');
		$this->dropTable('{{portfolio_portfolio_tag}}');
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