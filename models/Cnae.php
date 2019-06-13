<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnae".
 *
 * @property int $id
 * @property string $codigo
 * @property string $descricao
 *
 * @property Cnpj[] $cnpjs
 * @property CnpjCnaeSecundaria[] $cnpjCnaeSecundarias
 */
class Cnae extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnae';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descricao'], 'required'],
            [['codigo'], 'string', 'max' => 255],
            [['descricao'], 'string', 'max' => 500],
            [['codigo'], 'unique'],
            [['descricao'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnpjs()
    {
        return $this->hasMany(Cnpj::className(), ['cnae_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnpjCnaeSecundarias()
    {
        return $this->hasMany(CnpjCnaeSecundaria::className(), ['cnae_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CnaeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CnaeQuery(get_called_class());
    }
}
