<?php

use yii\db\Migration;

/**
 * Class m200229_171410_add_algorithm_table
 */
class m200229_171410_add_algorithm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * create {{algorithm}} table
         * */
        $this->createTable('{{algorithm}}', [
            'id'               => $this->primaryKey(),
            'number'           => $this->integer()->notNull(),
            'array'            => $this->string()->notNull(),
            'response'         => $this->string()->defaultValue(NULL),
            'timestamp'        => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200229_171410_add_algorithm_table cannot be reverted.\n";
        $this->dropTable('{{algorithm}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200229_171410_add_algorithm_table cannot be reverted.\n";

        return false;
    }
    */
}
