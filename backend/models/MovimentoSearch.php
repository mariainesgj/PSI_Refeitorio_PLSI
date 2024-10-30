<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class MovimentoSearch extends Movimento
{
    public $data;

    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['tipo', 'data'], 'safe'],
            [['quantidade', 'origem'], 'number'],
        ];
    }

    public function search($params)
    {
        $query = Movimento::find();

        if (empty($params['MovimentoSearch']['data'])) {
            $params['MovimentoSearch']['data'] = date('Y-m-d');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // Filtro pela data
        if (!empty($this->data)) {
            $query->andFilterWhere(['date(data)' => $this->data]);
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['user_id' => $this->user_id])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'origem', $this->origem]);

        return $dataProvider;
    }
}

