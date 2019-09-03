<?php

use yii\db\Migration;

/**
 * Handles the creation of table `airo_trips`.
 */
class m190828_124027_create_airo_trips_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%airo_trips}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->comment('Адрес'),
            'date_from' => $this->dateTime()->comment('Дата и время С'),
            'date_to' => $this->dateTime()->comment('Дата и время До'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%airo_trips}}');
    }
}
