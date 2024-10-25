<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SenhaSearch extends Senha
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'prato_id'], 'integer'],
            [['lido'], 'string'],
            [['data'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Senha::find()
            ->joinWith('ementa');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'senhas.data', $this->data]);
        return $dataProvider;
    }

}

