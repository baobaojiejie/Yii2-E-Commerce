<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_item}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%order}}`
 */
class m220210_066556_create_cart_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart_item}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(2)->notNull(),
            'created_by'=>$this->integer(11)->notNull()
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-cart_item-product_id}}',
            '{{%cart_item}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-cart_item-product_id}}',
            '{{%cart_item}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-cart_item-created_by}}',
            '{{%cart_item}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-cart_item-created_by}}',
            '{{%cart_item}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-cart_item-product_id}}',
            '{{%cart_item}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-cart_item-product_id}}',
            '{{%cart_item}}'
        );

        // drops foreign key for table `{{%order}}`
        $this->dropForeignKey(
            '{{%fk-cart_item-order_id}}',
            '{{%cart_item}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-cart_item-order_id}}',
            '{{%cart_item}}'
        );

        $this->dropTable('{{%cart_item}}');
    }
}
