<?php

namespace modules\sprint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\sprint\models\StoryAcceptance;

/**
 * StoryAcceptanceSearch represents the model behind the search form of `modules\sprint\models\StoryAcceptance`.
 */
class StoryAcceptanceSearch extends StoryAcceptance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'story_id', 'creator_id', 'created_at', 'updated_at'], 'integer'],
            [['acceptance'], 'safe'],
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
        $query = StoryAcceptance::find();

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
            'id' => $this->id,
            'project_id' => $this->project_id,
            'story_id' => $this->story_id,
            'creator_id' => $this->creator_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'acceptance', $this->acceptance]);

        return $dataProvider;
    }
}
