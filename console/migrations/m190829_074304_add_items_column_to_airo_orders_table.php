<?php

use yii\db\Migration;

/**
 * Handles adding items to table `airo_orders`.
 */
class m190829_074304_add_items_column_to_airo_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        $this->addColumn('{{%airo_orders}}', 'items', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%airo_orders}}', 'items');
    }
}
