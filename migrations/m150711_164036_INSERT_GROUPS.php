<?php

use yii\db\Schema;
use yii\db\Migration;

class m150711_164036_INSERT_GROUPS extends Migration
{
    public function up()
    {
        $this->insert('group', ['id' => 1, 'name' => 'User']);
        $this->insert('group', ['id' => 2, 'name' => 'Moderator']);
        $this->insert('group', ['id' => 3, 'name' => 'Admin']);
    }

    public function down()
    {
        echo "m150711_164036_INSERT_GROUPS cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
