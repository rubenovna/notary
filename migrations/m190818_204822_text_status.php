<?php

use yii\db\Migration;

/**
 * Class m190818_204822_text_status
 */
class m190818_204822_text_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert(
            'doc_statuses',[
                'description' => 'New',

            ]
        );

        $this->insert(
            'doc_statuses',[
                'description' => 'Выполнен',

            ]
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

$this->dropTable('text_status');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_204822_text_status cannot be reverted.\n";

        return false;
    }
    */
}
