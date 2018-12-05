<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RobotMessage;

/**
 * RobotMessageSearch represents the model behind the search form of `app\models\RobotMessage`.
 */
class RobotMessageSearch extends RobotMessage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'name', 'msg_subject', 'subject_vars', 'msg_body', 'body_vars'], 'safe'],
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
        $query = RobotMessage::find();

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
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'msg_subject', $this->msg_subject])
            ->andFilterWhere(['like', 'subject_vars', $this->subject_vars])
            ->andFilterWhere(['like', 'msg_body', $this->msg_body])
            ->andFilterWhere(['like', 'body_vars', $this->body_vars]);

        return $dataProvider;
    }
}
