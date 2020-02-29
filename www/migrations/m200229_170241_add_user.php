<?php

use yii\db\Migration;
use app\models\User;
/**
 * Class m200229_170241_add_user
 */
class m200229_170241_add_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->createUser('admin', 'admin');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200229_170241_add_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200229_170241_add_user cannot be reverted.\n";

        return false;
    }
    */
}
