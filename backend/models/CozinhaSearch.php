<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CozinhaSearch extends Cozinha
{
    public $localizacao;

    public function rules()
    {
        return [
            [['localizacao'], 'safe'],

        ];
    }

    public function search($params)
    {
        $query = Cozinha::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'localizacao', $this->localizacao]);

        return $dataProvider;
    }
}

