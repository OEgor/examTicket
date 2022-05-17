<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\UserStatus;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public function rules()
    {
        return [
            [['username', 'password', 'user_status_id'], 'required'],
            [['user_id', 'user_status_id'], 'integer'],
            [['username', 'password'], 'string', 'max' => 100],
            
        ];
    }
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->user_id;
    }

    public function getStatusCode()
    {
        $usi = $this->user_status_id;
        return UserStatus::find()->where(['user_status_id' => $usi])->one()->user_status_code;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @return string current user auth key
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validatePassword($password)
    {
        // exit($this->getPassword());
        return $this->getPassword() === sha1($password);
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
}