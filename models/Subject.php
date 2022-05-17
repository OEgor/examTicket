<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $subject_id
 * @property string $subject_title
 *
 * @property Question[] $questions
 * @property UserSubject[] $userSubjects
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_title'], 'required'],
            [['subject_title'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_title' => 'Subject Title',
        ];
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * Gets query for [[UserSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserSubjects()
    {
        return $this->hasMany(UserSubject::className(), ['subject_id' => 'subject_id']);
    }

    public static function getSubjectTitle($subject_id)
    {
        //return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
        return static::findOne(['subject_id' => $subject_id])->subject_title;
    }
}
