<?php

namespace app\models;
use yii\base\Model;

class Signup extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass'=>'app\models\User'],
            [['username', 'password'], 'string', 'min' => 5, 'max' => 100]
        ];
    }

    public function Signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->user_status_id = 3;
        return $user->save();
    }
}