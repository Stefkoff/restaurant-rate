<?php

use yii\db\Schema;
use yii\db\Command;
use yii\db\Migration;

class m150711_091845_CREATE_user_TABLE extends Migration
{
    public function up()
    {
        $sql = <<<SQL
CREATE DATABASE `restaurant` /*!40100 DEFAULT CHARACTER SET utf8 */;
    
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `auth_token` varchar(64) DEFAULT NULL,
  `access_token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
SQL;
        $command = new Command();
        $command->execute($sql);
    }

    public function down()
    {
        $this->dropTable('user');

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
