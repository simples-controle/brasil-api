<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnpj_cnae_secundaria".
 *
 * @property int $id
 * @property int $cnae_id
 * @property int $cnpj_id
 *
 * @property Cnae $cnae
 * @property Cnpj $cnpj
 */
class CnpjCnaeSecundaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnpj_cnae_secundaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cnae_id', 'cnpj_id'], 'required'],
            [['cnae_id', 'cnpj_id'], 'integer'],
            [['cnae_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cnae::className(), 'targetAttribute' => ['cnae_id' => 'id']],
            [['cnpj_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cnpj::className(), 'targetAttribute' => ['cnpj_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cnae_id' => 'Cnae ID',
            'cnpj_id' => 'Cnpj ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnae()
    {
        return $this->hasOne(Cnae::className(), ['id' => 'cnae_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnpj()
    {
        return $this->hasOne(Cnpj::className(), ['id' => 'cnpj_id']);
    }

    /**
     * @inheritdoc
     * @return CnpjCnaeSecundariaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CnpjCnaeSecundariaQuery(get_called_class());
    }
}
