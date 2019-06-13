<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnpj".
 *
 * @property int $id
 * @property string $nome
 * @property string $uf
 * @property string $telefone
 * @property string $email
 * @property string $situacao
 * @property string $bairro
 * @property string $logradouro
 * @property string $numero
 * @property string $cep
 * @property string $municipio
 * @property string $porte
 * @property string $abertura
 * @property string $natureza_juridica
 * @property string $fantasia
 * @property string $cnpj
 * @property string $ultima_atualizacao
 * @property string $status
 * @property string $tipo
 * @property string $complemento
 * @property string $efr
 * @property string $motivo_situacao
 * @property string $situacao_especial
 * @property string $data_situacao_especial
 * @property string $capital_social
 * @property string $data_situacao
 * @property string $extra
 * @property int $cnae_id
 *
 * @property Cnae $cnae
 * @property CnpjCnaeSecundaria[] $cnpjCnaeSecundarias
 */
class Cnpj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnpj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'cnpj', 'cnae_id'], 'required'],
            [['complemento', 'motivo_situacao', 'situacao_especial'], 'string'],
            [['cnae_id'], 'integer'],
            [['nome', 'bairro', 'logradouro', 'numero', 'cep', 'municipio', 'porte', 'natureza_juridica', 'fantasia', 'cnpj', 'ultima_atualizacao', 'tipo', 'efr', 'capital_social'], 'string', 'max' => 255],
            [['uf'], 'string', 'max' => 2],
            [['telefone', 'status', 'data_situacao_especial', 'data_situacao', 'extra'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 500],
            [['situacao', 'abertura'], 'string', 'max' => 100],
            [['cnae_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cnae::className(), 'targetAttribute' => ['cnae_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'uf' => 'Uf',
            'telefone' => 'Telefone',
            'email' => 'Email',
            'situacao' => 'Situacao',
            'bairro' => 'Bairro',
            'logradouro' => 'Logradouro',
            'numero' => 'Numero',
            'cep' => 'Cep',
            'municipio' => 'Municipio',
            'porte' => 'Porte',
            'abertura' => 'Abertura',
            'natureza_juridica' => 'Natureza Juridica',
            'fantasia' => 'Fantasia',
            'cnpj' => 'Cnpj',
            'ultima_atualizacao' => 'Ultima Atualizacao',
            'status' => 'Status',
            'tipo' => 'Tipo',
            'complemento' => 'Complemento',
            'efr' => 'Efr',
            'motivo_situacao' => 'Motivo Situacao',
            'situacao_especial' => 'Situacao Especial',
            'data_situacao_especial' => 'Data Situacao Especial',
            'capital_social' => 'Capital Social',
            'data_situacao' => 'Data Situacao',
            'extra' => 'Extra',
            'cnae_id' => 'Cnae ID',
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
    public function getCnpjCnaeSecundarias()
    {
        return $this->hasMany(Cnae::className(), ['id' => 'cnae_id'])->viaTable('cnpj_cnae_secundaria', ['cnpj_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CnpjQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CnpjQuery(get_called_class());
    }
}
