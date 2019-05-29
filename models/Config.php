<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property string $cosmos_key
 * @property string $data_criacao
 * @property string $data_atualizacao
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cosmos_key', 'data_criacao', 'data_atualizacao'], 'required'],
            [['cosmos_key', 'data_criacao', 'data_atualizacao'], 'string', 'max' => 255],
            [['cosmos_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cosmos_key' => 'Cosmos Key',
            'data_criacao' => 'Data Criacao',
            'data_atualizacao' => 'Data Atualizacao',
        ];
    }
}
