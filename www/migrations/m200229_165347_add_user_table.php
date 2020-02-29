<?php

use yii\db\Migration;

/**
 * Class m200229_165347_add_user_table
 */
class m200229_165347_add_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * create {{user}} table
         * */
        $this->createTable('{{user}}', [
            'id'               => $this->primaryKey(),
            'username'         => $this->char(255)->defaultValue(NULL),
            'auth_key'         => $this->char(255)->defaultValue(NULL),
            'password_hash'    => $this->char(255)->defaultValue(NULL),
            'timestamp'        => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200227_051628_users_table cannot be reverted.\n";

        $this->dropTable('{{%user}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200229_165347_add_user_table cannot be reverted.\n";

        return false;
    }
    */
}
