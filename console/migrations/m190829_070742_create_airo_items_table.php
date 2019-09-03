<?php

use yii\db\Migration;

/**
 * Handles the creation of table `airo_items`.
 */
class m190829_070742_create_airo_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%airo_items}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название'),
            'price' => $this->decimal(10,2)->comment('Цена')
        ]);

        $this->insert('{{%airo_items}}', [
            'name' => 'Пиджак',
            'price' => '1000',
        ]);
        $this->insert('{{%airo_items}}', [
            'name' => 'Брюки',
            'price' => '1200',
        ]);
        $this->insert('{{%airo_items}}', [
            'name' => 'Рубашка',
            'price' => '500',
        ]);
        $this->insert('{{%airo_items}}', [
            'name' => 'Пальто',
            'price' => '5000',
        ]);
        $this->insert('{{%airo_items}}', [
            'name' => 'Шорты',
            'price' => '300',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%airo_items}}');
    }
}
