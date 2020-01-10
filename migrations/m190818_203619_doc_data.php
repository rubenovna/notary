<?php

use yii\db\Migration;

/**
 * Class m190818_203619_doc_data
 */
class m190818_203619_doc_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('doc_data', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'role' => $this->string(25),
            'name' => $this->string(25),
            'email' => $this->string(25),
            'text' => $this->text(),

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('doc_data');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_203619_doc_data cannot be reverted.\n";

        return false;
    }
    */
}
