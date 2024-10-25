<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ementa;

class EmentaSearch extends Model
{
    public $data;

    /**
     * Regras de validação para o campo de pesquisa.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
        ];
    }

    /**
     * Configura o cenário de pesquisa.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
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

        return $dataProvider;
    }
}

