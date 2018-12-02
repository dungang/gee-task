<?php

namespace modules\meet\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\meet\models\Meet;
use app\helpers\MiscHelper;

/**
 * MeetSearch represents the model behind the search form of `modules\meet\models\Meet`.
 */
class MeetSearch extends Meet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'creator_id', 'is_del'], 'integer'],
            [['created_at', 'updated_at'], 'date','format'=>'yyyy-mm-dd'],
            [['actors', 'meet_date', 'title', 'content'], 'safe'],
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
        $query = Meet::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'meet_date' => SORT_DESC,
                ]
            ],
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
            'meet_date' => $this->meet_date,
            'creator_id' => $this->creator_id,
            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'actors', $this->actors])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(MiscHelper::betweenDayWithTimestamp('updated_at',$this->updated_at))
            ->andFilterWhere(MiscHelper::betweenDayWithTimestamp('created_at',$this->created_at));

        return $dataProvider;
    }
}
