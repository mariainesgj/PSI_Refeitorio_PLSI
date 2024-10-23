<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pratos".
 *
 * @property int $id
 * @property string $designacao
 * @property string $componentes
 * @property string|null $tipo
 *
 * @property Senhas[] $senhas
 */
class Prato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pratos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designacao', 'componentes'], 'required'],
            [['tipo'], 'string'],
            [['designacao', 'componentes'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designacao' => 'Designacao',
            'componentes' => 'Componentes',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[Senhas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSenhas()
    {
        return $this->hasMany(Senhas::class, ['prato_id' => 'id']);
    }
}
