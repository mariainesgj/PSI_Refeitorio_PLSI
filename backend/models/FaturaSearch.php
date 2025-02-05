<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fatura;

class FaturaSearch extends Fatura
{
    public $searchTerm;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['total_iliquido', 'total_doc', 'total_iva'], 'number'],
            [['data'], 'safe'],
            [['searchTerm'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Fatura::find()
            ->joinWith('userProfile');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'total_iliquido', $this->total_iliquido])
            ->andFilterWhere(['like', 'total_doc', $this->total_doc])
            ->andFilterWhere(['like', 'total_iva', $this->total_iva])
            ->andFilterWhere(['like', 'data', $this->data]);

        if ($this->searchTerm) {
            $query->orFilterWhere(['like', 'profile.name', $this->searchTerm])
                ->orFilterWhere(['like', 'profile.mobile', $this->searchTerm]);
        }

        return $dataProvider;
    }
}
