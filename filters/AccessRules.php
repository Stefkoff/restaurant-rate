<?php
/**
 * Description of AccessRule
 *
 * @author Georgi
 */

namespace app\filters;

use Yii;
use yii\filters\AccessRule;

class AccessRules extends AccessRule{
    protected function matchRole($user){
        if(empty($this->roles)){
            return true;
        }
        
        foreach ($this->roles as $role){
            if($role === 'admin' ){
                if(Yii::$app->user->identity->isAdmin()){
                    return true;
                }
            } else if($role === 'moderator'){
                if(Yii::$app->user->isModerator()){
                    return true;
                }
            } else if($role === '?'){
                if(Yii::$app->user->isGuest){
                    return true;
                }
            } else if($role === '@'){
                if(!Yii::$app->user->isGuest){
                    return true;
                }
            }
        }
    }
}
