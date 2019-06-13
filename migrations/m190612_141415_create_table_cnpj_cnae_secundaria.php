<?php

use yii\db\Migration;

/**
 * Class m190612_141415_create_table_cnpj_cnae_secundaria
 */
class m190612_141415_create_table_cnpj_cnae_secundaria extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('cnpj_cnae_secundaria', [
            'id' => $this->primaryKey(),
            'cnae_id' => $this->integer()->notNull(),
            'cnpj_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-cnpj_cnae_secundaria-cnae_id',
            'cnpj_cnae_secundaria',
            'cnae_id',
            'cnae',
            'id'
        );

        $this->addForeignKey(
            'fk-cnpj_cnae_secundaria-cnpj_id',
            'cnpj_cnae_secundaria',
            'cnpj_id',
            'cnpj',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190612_141415_create_table_cnpj_cnae_secundaria cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_141415_create_table_cnpj_cnae_secundaria cannot be reverted.\n";

        return false;
    }
    */
}
