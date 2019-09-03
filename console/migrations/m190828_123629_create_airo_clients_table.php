<?php

use yii\db\Migration;

/**
 * Handles the creation of table `airo_clients`.
 */
class m190828_123629_create_airo_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%airo_clients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Имя'),
            'phone' => $this->string()->comment('Телефон'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%airo_clients}}');
    }
}
