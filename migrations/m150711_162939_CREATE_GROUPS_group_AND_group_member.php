<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Command;

class m150711_162939_CREATE_GROUPS_group_AND_group_member extends Migration
{
    public function up()
    {
        
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
                
CREATE TABLE IF NOT EXISTS `group_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `group_idx` (`group_id`),
  KEY `user_idx` (`user_id`),
  CONSTRAINT `group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
SQL;
        
        $command = new Command();
        $command->execute($sql);
    }

    public function down()
    {
        $this->dropTable('group');
        $this->dropTable('group_member');

        return false;
    }
}
