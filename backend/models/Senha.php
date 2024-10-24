<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "senhas".
 *
 * @property int $id
 * @property string $data
 * @property int $anulado
 * @property int $consumido
 * @property string $criado
 * @property string|null $alterado
 * @property float $valor
 * @property string $descricao
 * @property float $iva
 * @property int $user_id
 * @property int $ementa_id
 * @property int $prato_id
 *
 * @property Ementa $ementa
 * @property Linhascarrinho[] $linhascarrinhos
 * @property Linhasfatura[] $linhasfaturas
 * @property Prato $prato
 * @property User $user
 */
class Senha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'senhas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'valor', 'descricao', 'iva', 'user_id', 'ementa_id', 'prato_id'], 'required'],
            [['data', 'criado', 'alterado'], 'safe'],
            [['anulado', 'consumido'], 'boolean'],
            [['user_id', 'ementa_id', 'prato_id'], 'integer'],
            [['valor', 'iva'], 'number'],
            [['descricao'], 'string', 'max' => 255],
            [['ementa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ementa::class, 'targetAttribute' => ['ementa_id' => 'id']],
            [['prato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prato::class, 'targetAttribute' => ['prato_id' => 'id']],
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
            'data' => 'Data',
            'anulado' => 'Anulado',
            'consumido' => 'Consumido',
            'criado' => 'Criado',
            'alterado' => 'Alterado',
            'valor' => 'Valor',
            'descricao' => 'Descricao',
            'iva' => 'Iva',
            'user_id' => 'User ID',
            'ementa_id' => 'Ementa ID',
            'prato_id' => 'Prato ID',
        ];
    }

    /**
     * Gets query for [[Ementa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmenta()
    {
        return $this->hasOne(Ementa::class, ['id' => 'ementa_id']);
    }

    /**
     * Gets query for [[Linhascarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhascarrinhos()
    {
        return $this->hasMany(Linhascarrinho::class, ['senha_id' => 'id']);
    }

    /**
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturas()
    {
        return $this->hasMany(Linhasfatura::class, ['senha_id' => 'id']);
    }

    /**
     * Gets query for [[Prato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrato()
    {
        return $this->hasOne(Prato::class, ['id' => 'prato_id']);
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
}
