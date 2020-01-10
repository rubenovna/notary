<?php

use yii\db\Migration;

/**
 * Class m190818_204316_doc_statuses
 */
class m190818_204316_doc_statuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$this->createTable('doc_statuses', [
            'id' => $this->primaryKey(),
    'description' => $this->string(11),

    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('doc_statuses');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_204316_doc_statuses cannot be reverted.\n";

        return false;
    }
    */
}
