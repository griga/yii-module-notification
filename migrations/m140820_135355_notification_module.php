<?php

class m140820_135355_notification_module extends DbMigration
{
	public function up()
	{
        $this->createTable('{{notification}}',[
            'id'=>'pk',
            'subject'=>'VARCHAR(250) NOT NULL',
            'message'=>'TEXT NOT NULL',
            'type'=>'TINYINT NOT NULL',
            'status'=>'TINYINT NOT NULL DEFAULT 0',
            'create_time'=>'DATETIME',
            'update_time'=>'DATETIME',
            'user_id'=>'INT NULL DEFAULT NULL',
        ]);
	}

	public function down()
	{
        $this->dropTable('{{notification}}');
	}
}