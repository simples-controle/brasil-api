<?php

use yii\db\Migration;

/**
 * Class m190527_205333_add_tabela_configuracao
 */
class m190527_205333_add_tabela_configuracao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'cosmos_key' => $this->string(255)->notNull()->unique(),
            'data_criacao' => $this->string()->notNull(),
            'data_atualizacao' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_205333_add_tabela_configuracao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_205333_add_tabela_configuracao cannot be reverted.\n";

        return false;
    }
    */
}
