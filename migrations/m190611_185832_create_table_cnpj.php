<?php

use yii\db\Migration;

/**
 * Class m190611_185832_create_table_cnpj
 */
class m190611_185832_create_table_cnpj extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('cnpj', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'uf' => $this->string(2),
            'telefone' => $this->string(50),
            'email' => $this->string(500),
            'situacao' => $this->string(100),
            'bairro' => $this->string(255),
            'logradouro' => $this->string(255),
            'numero' => $this->string(255),
            'cep' => $this->string(255),
            'municipio' => $this->string(255),
            'porte' => $this->string(255),
            'abertura' => $this->string(100),
            'natureza_juridica' => $this->string(255),
            'fantasia' => $this->string(255),
            'cnpj' => $this->string(255)->notNull(),
            'ultima_atualizacao' => $this->string(255),
            'status' => $this->string(50),
            'tipo' => $this->string(255),
            'complemento' => $this->text(),
            'efr' => $this->string(255),
            'motivo_situacao' => $this->text(),
            'situacao_especial' => $this->text(),
            'data_situacao_especial' => $this->string(50),
            'capital_social' => $this->string(255),
            'data_situacao' => $this->string(50),
            'extra' => $this->string(50),
            'cnae_id' => $this->integer()->notNull(),
        ]);

         $this->addForeignKey(
            'fk-cnpj-cnae_id',
            'cnpj',
            'cnae_id',
            'cnae',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190611_185832_create_table_cnpj cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190611_185832_create_table_cnpj cannot be reverted.\n";

        return false;
    }
    */
}
