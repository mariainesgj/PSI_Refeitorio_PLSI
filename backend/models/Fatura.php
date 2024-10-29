<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property float $total
 * @property float $iva
 * @property string $data
 * @property int $user_id
 *
 * @property Linhasfaturas[] $linhasfaturas
 * @property User $user
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total', 'iva', 'data', 'user_id'], 'required'],
            [['total', 'iva'], 'number'],
            [['data'], 'safe'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total' => 'Total',
            'iva' => 'Iva',
            'data' => 'Data',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturas()
    {
        return $this->hasMany(Linhasfatura::class, ['fatura_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getUserProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'user_id']);
    }
}
