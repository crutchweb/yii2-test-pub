<?php

use yii\db\Migration;

/**
 * Class m200229_172528_add_log_table
 */
class m200229_172528_add_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * create {{log}} table
         * */
        $this->createTable('{{log}}', [
            'id'               => $this->primaryKey(),
            'user_id'          => $this->integer(),
            'algorithm_id'     => $this->integer()->notNull(),
            'method'           => $this->char(255)->defaultValue(NULL),
            'request'          => $this->string()->defaultValue(NULL),
            'response'         => $this->string()->defaultValue(NULL),
            'timestamp'        => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('fk_log_algorithm_id', '{{log}}',
            'algorithm_id', '{{algorithm}}', 'id','CASCADE','RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200229_172528_add_log_table cannot be reverted.\n";
        $this->dropTable('{{log}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200229_172528_add_log_table cannot be reverted.\n";

        return false;
    }
    */
}
