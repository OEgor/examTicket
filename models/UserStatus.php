<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_status".
 *
 * @property int $user_status_id
 * @property string $user_status_title
 * @property string $user_status_code
 */
class UserStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_status_title', 'user_status_code'], 'required'],
            [['user_status_title', 'user_status_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_status_id' => 'User Status ID',
            'user_status_title' => 'User Status Title',
            'user_status_code' => 'User Status Code',
        ];
    }

   
}
