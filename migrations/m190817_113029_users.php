<?php

use yii\db\Migration;

/**
 * Class m190817_113029_users
 */
class m190817_113029_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('users',[
             'id' => $this->primaryKey(),
             'username' => $this->string(25),
             'email' => $this->string(25),
             'password' => $this->string(255),
             'status' => $this->string(25),
             'auth_key' => $this->string(255),
             'created_at' => $this->string(60),
             'updated_at' => $this->string(60),
             'role' => $this->string(25),
             'secret_key' => $this->string(255),

   ] );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190817_113029_users cannot be reverted.\n";

        return false;
    }
    */
}
