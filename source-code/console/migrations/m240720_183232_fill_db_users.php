<?php

use yii\db\Migration;

/**
 * Class m240720_183232_fill_db_users
 */
class m240720_183232_fill_db_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ .'/dump/test_users.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240720_183232_fill_db_users cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240720_183232_fill_db_users cannot be reverted.\n";

        return false;
    }
    */
}
