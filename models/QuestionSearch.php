<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Question;

/**
 * QuestionSearch represents the model behind the search form of `app\models\Question`.
 */
class QuestionSearch extends Question
{
    public $subjectTitle;
    public $questionContent;
    public $questionType;
    public $questionDifficult;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'subject_id', 'question_difficult', 'question_type_id', 'creator_id'], 'integer'],
            [['questionContent', 'subjectTitle','questionType','questionDifficult'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $creator_id = -1)
    {
        $query = Question::find();
        $query->joinWith(['subject']);
        $query->joinWith(['questionType']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['subjectTitle'] = [
            'asc' => [Subject::tableName().'.subject_title' => SORT_ASC],
            'desc' => [Subject::tableName().'.subject_title' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['questionContent'] = [
            'asc' => [Question::tableName().'.question_content' => SORT_ASC],
            'desc' => [Question::tableName().'.question_content' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['questionDifficult'] = [
            'asc' => [Question::tableName().'.question_difficult' => SORT_ASC],
            'desc' => [Question::tableName().'.question_difficult' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['questionType'] = [
            'asc' => [QuestionType::tableName().'.question_type_title' => SORT_ASC],
            'desc' => [QuestionType::tableName().'.question_type_title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if($creator_id == -1)
        {
            $query->andFilterWhere([
            'question_id' => $this->question_id,
            'subject_id' => $this->subject_id,
            'question_difficult' => $this->question_difficult,
            'question_type_id' => $this->question_type_id,
            'creator_id' => $this->creator_id,
            ]);
        }
        else
        {
            $query->andFilterWhere([
                'question_id' => $this->question_id,
                'subject_id' => $this->subject_id,
                'question_difficult' => $this->question_difficult,
                'question_type_id' => $this->question_type_id,
                'creator_id' => $creator_id,
            ]);
        }
        $query->andFilterWhere(['like', 'question_content', $this->questionContent])
            ->andFilterWhere(['like', 'question_difficult', $this->questionDifficult])        
            ->andFilterWhere(['like', QuestionType::tableName().'.question_type_title', $this->questionType])  
            ->andFilterWhere(['like', Subject::tableName().'.subject_title', $this->subjectTitle]);

        return $dataProvider;
    }
}
