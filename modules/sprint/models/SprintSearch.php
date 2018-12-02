<?php
namespace modules\sprint\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\sprint\models\Sprint;
use app\helpers\MiscHelper;

/**
 * SprintSearch represents the model behind the search form of `modules\sprint\models\Sprint`.
 */
class SprintSearch extends Sprint
{

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'project_id',
                    'is_del'
                ],
                'integer'
            ],
            [
                [
                    'created_at',
                    'updated_at'
                ],
                'date',
                'format' => 'yyyy-mm-dd'
            ],
            [
                [
                    'status',
                    'start_date',
                    'end_date',
                    'name'
                ],
                'safe'
            ]
        ];
    }

    /**
     *
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
        $query = Sprint::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'status' => [
                        'asc' => [
                            'status' => SORT_ASC,
                            'created_at' => SORT_DESC
                        ],
                        'desc' => [
                            'status' => SORT_DESC,
                            'created_at' => SORT_DESC
                        ],
                        'default' => SORT_ASC
                    ]
                ],
                'defaultOrder' => [
                    'status' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_del' => $this->is_del
        ]);

        $query->andFilterWhere([
            'like',
            'status',
            $this->status
        ])
            ->andFilterWhere([
            'like',
            'name',
            $this->name
        ])
            ->andFilterWhere(MiscHelper::betweenDayWithTimestamp('updated_at', $this->updated_at))
            ->andFilterWhere(MiscHelper::betweenDayWithTimestamp('created_at', $this->created_at));

        return $dataProvider;
    }
}
