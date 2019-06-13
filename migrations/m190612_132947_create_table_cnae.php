<?php

use yii\db\Migration;

/**
 * Class m190612_132947_create_table_cnae
 */
class m190612_132947_create_table_cnae extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('cnae', [
            'id' => $this->primaryKey(),
            'codigo' => $this->string(255)->notNull()->unique(),
            'descricao' => $this->string(500)->notNull()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m190612_132947_create_table_cnae cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_132947_create_table_cnae cannot be reverted.\n";

        return false;
    }
    */
}
