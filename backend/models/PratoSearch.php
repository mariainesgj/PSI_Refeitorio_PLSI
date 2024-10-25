<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PratoSearch extends Prato
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['designacao', 'componentes', 'tipo'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Prato::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'designacao', $this->designacao]);

        return $dataProvider;
    }
}

