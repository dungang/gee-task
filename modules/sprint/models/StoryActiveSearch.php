<?php

namespace modules\sprint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\sprint\models\StoryActive;

/**
 * StoryActiveSearch represents the model behind the search form of `modules\sprint\models\StoryActive`.
 */
class StoryActiveSearch extends StoryActive
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'story_id', 'creator_id', 'created_at'], 'integer'],
            [['old_status', 'new_status', 'remark'], 'safe'],
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
        $query = StoryActive::find();

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
            'story_id' => $this->story_id,
            'creator_id' => $this->creator_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'old_status', $this->old_status])
            ->andFilterWhere(['like', 'new_status', $this->new_status])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
