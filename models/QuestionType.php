<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_type".
 *
 * @property int $question_type_id
 * @property string $question_type_title
 *
 * @property Question[] $questions
 */
class QuestionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_type_title'], 'required'],
            [['question_type_title'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_type_id' => 'Question Type ID',
            'question_type_title' => 'Question Type Title',
        ];
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['question_type_id' => 'question_type_id']);
    }

    public static function getQuestionTypeTitle($question_type_id)
    {
        //return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
        return static::findOne(['question_type_id' => $question_type_id])->question_type_title;
    }
}
