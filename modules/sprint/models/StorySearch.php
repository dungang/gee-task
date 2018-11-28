<?php

namespace modules\sprint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\sprint\models\Story;

/**
 * StorySearch represents the model behind the search form of `modules\sprint\models\Story`.
 */
class StorySearch extends Story
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sprint_id', 'important', 'project_id', 'user_id', 'last_user_id', 'creator_id', 'created_at', 'updated_at', 'is_del'], 'integer'],
            [['story_type', 'status', 'name', 'project_version'], 'safe'],
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
        $query = Story::find();

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
            'sprint_id' => $this->sprint_id,
            'important' => $this->important,
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'last_user_id' => $this->last_user_id,
            'creator_id' => $this->creator_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'story_type', $this->story_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'project_version', $this->project_version]);

        return $dataProvider;
    }
}
