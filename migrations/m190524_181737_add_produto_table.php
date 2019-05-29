<?php

use yii\db\Migration;

/**
 * Class m190524_181737_add_produto_table
 */
class m190524_181737_add_produto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('produto', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull()->unique(),
            'descricao' => $this->text(),
            'gtin' => $this->string(500)->unique(),
            'ean' => $this->string(500)->unique(),
            'imagem_produto' => $this->text(),
            'preco' => $this->text(),
            'preco_medio' => $this->text(),
            'preco_maximo' => $this->text(),
            'preco_minimo' => $this->text(),
            'largura' => $this->text(),
            'altura' => $this->text(),
            'comprimento' => $this->text(),
            'peso_liquido' => $this->text(),
            'peso_bruto' => $this->text(),
            'imagem_codigo_barras' => $this->text(),
            'marca_nome' => $this->text(),
            'imagem_marca' => $this->text(),
            'gpc_codigo' => $this->text(),
            'gpc_descricao' => $this->text(),
            'tipo_embalagem' => $this->text(),
            'quantidade_embalagem' => $this->text(),
            'ncm_codigo' => $this->text(),
            'ncm_descricao' => $this->text(),
            'cest_codigo' => $this->text(),
            'cest_descricao' => $this->text(),
            'fabricante_nome' => $this->text(),
            'base_origem' => $this->text(),
            'data_criacao' => $this->string()->notNull(),
            'data_atualizacao' => $this->string()->notNull(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190524_181737_add_produto_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190524_181737_add_produto_table cannot be reverted.\n";

        return false;
    }
    */
}
