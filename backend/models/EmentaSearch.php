<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ementa;

class EmentaSearch extends Model
{
    public $data;
    public $cozinha_id;

    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['cozinha_id'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = Ementa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'data' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->data)) {
            $query->andFilterWhere(['like', 'data', $this->data]);
        }

        if ($this->cozinha_id) {
            $query->andFilterWhere(['cozinha_id' => $this->cozinha_id]);
        }

        return $dataProvider;
    }
}
