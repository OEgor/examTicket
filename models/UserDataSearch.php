<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserData;

/**
 * UserDataSearch represents the model behind the search form of `app\models\UserData`.
 */
class UserDataSearch extends UserData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_data_id', 'user_id'], 'integer'],
            [['user_family', 'user_name', 'user_patrynomic', 'user_email', 'user_phone'], 'safe'],
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
    public function search($params)
    {
        $query = UserData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_data_id' => $this->user_data_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'user_family', $this->user_family])
            ->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'user_patrynomic', $this->user_patrynomic])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'user_phone', $this->user_phone]);

        return $dataProvider;
    }
}
