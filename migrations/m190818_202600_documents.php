<?php

use yii\db\Migration;

/**
 * Class m190818_202600_documents
 */
class m190818_202600_documents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('documents', [
            'doc_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'role' => $this->string(25),
            'path' => $this->string(255),
            'signet_path' => $this->string(255),
            'doc_status' => $this->integer(11),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('documents');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_202600_documents cannot be reverted.\n";

        return false;
    }
    */
}
