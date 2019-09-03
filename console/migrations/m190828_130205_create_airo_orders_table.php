<?php

use yii\db\Migration;

/**
 * Handles the creation of table `airo_orders`.
 */
class m190828_130205_create_airo_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%airo_orders}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime(),
            'client_id' => $this->integer()->notNull(),
            'trip_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-airo_order-client_id',
            '{{%airo_orders}}',
            'client_id',
            '{{%airo_clients}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-airo_order-trip_id',
            '{{%airo_orders}}',
            'trip_id',
            '{{%airo_trips}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%airo_orders}}');
    }
}
