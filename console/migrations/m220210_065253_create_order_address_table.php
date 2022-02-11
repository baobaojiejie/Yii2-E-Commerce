<?php

use yii\db\Migration;

/**
 * have one-to-one relationship between order and order_address table
 * Handles the creation of table `{{%order_address}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%order}}`
 */
class m220210_065253_create_order_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_address}}', [
            'order_id' => $this->integer()->notNull(),
            'address' => $this->string(100)->notNull(),
            'city' => $this->string(50)->notNull(),
            'state' => $this->string(50)->notNull(),
            'country' => $this->string(50)->notNull(),
            'zipcode' => $this->string(50),
        ]);

        $this->addPrimaryKey('pk-order_address','{{%order_address}}','order_id');

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-order_address-order_id}}',
            '{{%order_address}}',
            'order_id'
        );

        // add foreign key for table `{{%order}}`
        $this->addForeignKey(
            '{{%fk-order_address-order_id}}',
            '{{%order_address}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%order}}`
        $this->dropForeignKey(
            '{{%fk-order_address-order_id}}',
            '{{%order_address}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-order_address-order_id}}',
            '{{%order_address}}'
        );

        $this->dropTable('{{%order_address}}');
    }
}
