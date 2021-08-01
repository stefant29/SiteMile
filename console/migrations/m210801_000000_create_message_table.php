<?php

use yii\db\Migration;

class m210801_000000_create_message_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'from' => $this->integer()->notNull(),
            'to' => $this->integer()->notNull(),
            'read_at' => $this->integer(),
            'message_text' => $this->text()->notNull(),
            'subject' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ], $tableOptions);



        // creates index for column `created_by`
        $this->createIndex(
            "{{%idx-message-created_by}}",
            "{{%message}}",
            'created_by'
        );

        // add foreign key for table "{{%user}}"
        $this->addForeignKey(
            "{{%fk-message-created_by}}",
            "{{%message}}",
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            "{{%idx-message-updated_by}}",
            "{{%message}}",
            'updated_by'
        );

        // add foreign key for table "{{%user}}"
        $this->addForeignKey(
            "{{%fk-message-updated_by}}",
            "{{%message}}",
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `from`
        $this->createIndex(
            "{{%idx-message-from}}",
            "{{%message}}",
            'from'
        );

        // add foreign key for table "{{%user}}"
        $this->addForeignKey(
            "{{%fk-message-from}}",
            "{{%message}}",
            'from',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `to`
        $this->createIndex(
            "{{%idx-message-to}}",
            "{{%message}}",
            'to'
        );

        // add foreign key for table "{{%user}}"
        $this->addForeignKey(
            "{{%fk-message-to}}",
            "{{%message}}",
            'to',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // drops foreign key created_by for table "{{%message}}"
        $this->dropForeignKey(
            "{{%fk-message-created_by}}",
            "{{%message}}"
        );

        // drops index for column `created_by`
        $this->dropIndex(
            "{{%idx-message-created_by}}",
            "{{%message}}"
        );

        // drops foreign key updated_by for table "{{%message}}"
        $this->dropForeignKey(
            "{{%fk-message-updated_by}}",
            "{{%message}}"
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            "{{%idx-message-updated_by}}",
            "{{%message}}"
        );

        // drops foreign key from for table "{{%message}}"
        $this->dropForeignKey(
            "{{%fk-message-from}}",
            "{{%message}}"
        );

        // drops index for column `from`
        $this->dropIndex(
            "{{%idx-message-from}}",
            "{{%message}}"
        );

        // drops foreign key to for table "{{%message}}"
        $this->dropForeignKey(
            "{{%fk-message-to}}",
            "{{%message}}"
        );

        // drops index for column `to`
        $this->dropIndex(
            "{{%idx-message-to}}",
            "{{%message}}"
        );

        $this->dropTable('{{%message}}');
    }
}
