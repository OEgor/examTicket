<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_data".
 *
 * @property int $user_data_id
 * @property int $user_id
 * @property string $user_family
 * @property string $user_name
 * @property string $user_patrynomic
 * @property string $user_email
 * @property string $user_phone
 *
 * @property User $user
 */
class UserData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user_family', 'user_name', 'user_patrynomic', 'user_email', 'user_phone'], 'required'],
            [['user_id'], 'integer'],
            [['user_family', 'user_name', 'user_patrynomic'], 'string', 'max' => 50],
            [['user_email'], 'string', 'max' => 100],
            [['user_phone'], 'string', 'max' => 13],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_data_id' => 'User Data ID',
            'user_id' => 'User ID',
            'user_family' => 'Фамилия',
            'user_name' => 'Имя',
            'user_patrynomic' => 'Отчество',
            'user_email' => 'Email',
            'user_phone' => 'Номер телефона',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
