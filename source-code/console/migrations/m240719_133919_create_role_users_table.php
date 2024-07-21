<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_users}}`.
 */
class m240719_133919_create_role_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%role_users}}',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'role_id' => $this->integer()->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role_users}}');
    }
}
