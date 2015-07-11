<?php

namespace app\models;

use Yii;
use app\models\Group;

/**
 * This is the model class for table "group_member".
 *
 * @property string $id
 * @property string $group_id
 * @property string $user_id
 *
 * @property Group $group
 * @property User $user
 */
class GroupMember extends \yii\db\ActiveRecord
{
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'user_id'], 'required'],
            [['group_id', 'user_id'], 'integer']
        ];
    }        

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'user_id' => 'User ID',
        ];
    }
    
    public function afterSave($insert, $changedAttributes) {
                        
        if($this->group_id == Group::GROUP_ADMIS){
            $self = new GroupMember();
            $self->group_id = Group::GROUP_MODERATORS;
            $self->user_id = $this->user_id;
            if(!$self->save()){
                Yii::info($self->getErrors());
                return false;
            }
        }
        
        if(parent::afterSave($insert, $changedAttributes)){
            return true;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
