<?php

use yii\db\Migration;

/**
 * Handles the creation of table `client_client`.
 * Has foreign keys to the tables:
 *
 * - `client`
 */
class m180523_153045_create_junction_for_contract_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contract', [
            'seller_id' => $this->integer(),
            'buyer_id' => $this->integer(),
            'number' => $this->integer()->notNull(),
            'date' => $this->integer()->notNull(),
            'amount' => $this->double()->notNull(),
            'description' => $this->text()->null(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY(number)',
        ]);

        // creates index for column `seller_id`
        $this->createIndex(
            'idx-contract-seller_id',
            'contract',
            'seller_id'
        );

        // add foreign key for table `client`
        $this->addForeignKey(
            'fk-contract-seller_id',
            'contract',
            'seller_id',
            'client',
            'id',
            'CASCADE'
        );

        // creates index for column `seller_id`
        $this->createIndex(
            'idx-contract-buyer_id',
            'contract',
            'buyer_id'
        );

        // add foreign key for table `client`
        $this->addForeignKey(
            'fk-contract-buyer_id',
            'contract',
            'buyer_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `client`
        $this->dropForeignKey(
            'fk-contract-buyer_id',
            'contract'
        );

        // drops index for column `client_id`
        $this->dropIndex(
            'idx-contract-buyer_id',
            'contract'
        );

        // drops foreign key for table `client`
        $this->dropForeignKey(
            'fk-contract-seller_id',
            'contract'
        );

        // drops index for column `client_id`
        $this->dropIndex(
            'idx-contract-seller_id',
            'contract'
        );

        $this->dropTable('contract');
    }
}
