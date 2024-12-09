<?php

namespace app\models;

use frontend\models\Carrinho;
use Yii;

/**
 * This is the model class for table "linhascarrinhos".
 *
 * @property int $id
 * @property int $carrinho_id
 * @property int|null $ementa_id
 * @property int|null $prato_id
 *
 * @property Carrinho $carrinho
 * @property Senha $senha
 */
class Linhascarrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhascarrinhos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrinho_id'], 'required'],
            [['carrinho_id', 'ementa_id', 'prato_id'], 'integer'],
            [['carrinho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinho::class, 'targetAttribute' => ['carrinho_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carrinho_id' => 'Carrinho ID',
            'ementa_id' => 'Ementa ID',
            'prato_id' => 'Prato ID',
        ];
    }

    /**
     * Gets query for [[Carrinho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinho()
    {
        return $this->hasOne(Carrinho::class, ['id' => 'carrinho_id']);
    }

    /**
     * Gets query for [[Senha]].
     *
     * @return \yii\db\ActiveQuery
     */

}
