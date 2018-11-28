<?php

namespace modules\robot\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\robot\models\ProjectRobot;

/**
 * ProjectRobotSearch represents the model behind the search form of `modules\robot\models\ProjectRobot`.
 */
class ProjectRobotSearch extends ProjectRobot
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'robot_id', 'project_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'webhook'], 'safe'],
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
        $query = ProjectRobot::find();

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
            'robot_id' => $this->robot_id,
            'project_id' => $this->project_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'webhook', $this->webhook]);

        return $dataProvider;
    }
}
