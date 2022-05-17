<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $question_id
 * @property int $subject_id
 * @property int $question_difficult
 * @property string $question_content
 * @property int $question_type_id
 * @property int $creator_id
 *
 * @property CourseQuestion[] $courseQuestions
 * @property User $creator
 * @property QuestionType $questionType
 * @property Subject $subject
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'question_difficult', 'question_content', 'question_type_id', 'creator_id'], 'required'],
            [['subject_id', 'question_difficult', 'question_type_id', 'creator_id'], 'integer'],
            [['question_content'], 'string'],
            [['question_content'], 'unique'],
            [['question_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionType::className(), 'targetAttribute' => ['question_type_id' => 'question_type_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'subject_id' => 'Subject ID',
            'question_difficult' => 'Question Difficult',
            'question_content' => 'Question Content',
            'question_type_id' => 'Question Type ID',
            'creator_id' => 'Creator ID',
        ];
    }

    /**
     * Gets query for [[CourseQuestions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseQuestions()
    {
        return $this->hasMany(CourseQuestion::className(), ['question_id' => 'question_id']);
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['user_id' => 'creator_id']);
    }

    /**
     * Gets query for [[QuestionType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionType()
    {
        return $this->hasOne(QuestionType::className(), ['question_type_id' => 'question_type_id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
    }
    
}
