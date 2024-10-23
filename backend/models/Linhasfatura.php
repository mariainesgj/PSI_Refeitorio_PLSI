<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "linhasfaturas".
 *
 * @property int $id
 * @property int $quantidade
 * @property float $total
 * @property float $iva
 * @property int $fatura_id
 * @property int $senha_id
 *
 * @property Faturas $fatura
 * @property Senhas $senha
 */
class Linhasfatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhasfaturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantidade', 'total', 'iva', 'fatura_id', 'senha_id'], 'required'],
            [['quantidade', 'fatura_id', 'senha_id'], 'integer'],
            [['total', 'iva'], 'number'],
            [['fatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faturas::class, 'targetAttribute' => ['fatura_id' => 'id']],
            [['senha_id'], 'exist', 'skipOnError' => true, 'targetClass' => Senhas::class, 'targetAttribute' => ['senha_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quantidade' => 'Quantidade',
            'total' => 'Total',
            'iva' => 'Iva',
            'fatura_id' => 'Fatura ID',
            'senha_id' => 'Senha ID',
        ];
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Faturas::class, ['id' => 'fatura_id']);
    }

    /**
     * Gets query for [[Senha]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSenha()
    {
        return $this->hasOne(Senhas::class, ['id' => 'senha_id']);
    }
}
