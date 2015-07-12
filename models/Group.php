<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property string $id
 * @property string $name
 *
 * @property GroupMember[] $groupMembers
 */
class Group extends \yii\db\ActiveRecord
{
    
    const GROUP_ADMIS = 3;
    const GROUP_MODERATORS = 2;
    const GROUP_USERS = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupMembers()
    {
        return $this->hasMany(GroupMember::className(), ['group_id' => 'id']);
    }
    
    public static function isValidGroup($id){
        $group = self::findOne($id);
        
        if($group){
            return true;
        }
        
        return false;
    }
}
