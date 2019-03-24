<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190323_200725_books
 */
class m190323_200725_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('book', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(256) NOT NULL',
            'author' => Schema::TYPE_STRING . '(256) NOT NULL',
            'year' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'pages' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'add_date' => Schema::TYPE_TIMESTAMP,
        ], $tableOptions);

//        $this->createTable('user', [
//            'id' => $this->primaryKey(),
//            'username' => $this->string()->notNull()->unique(),
//            'auth_key' => $this->string(32)->notNull(),
//            'password_hash' => $this->string()->notNull(),
//            'password_reset_token' => $this->string()->unique(),
//            'email' => $this->string()->notNull()->unique(),
//            'status' => $this->smallInteger()->notNull()->defaultValue(10),
//            'created_at' => $this->integer()->notNull(),
//            'updated_at' => $this->integer()->notNull(),
//        ], $tableOptions);

        $this->createTable('stat', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'complete' => $this->boolean()->notNull(),
            'percent' => $this->integer()->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->notNull(),
            'plan_end_date' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('book_id', 'stat', 'book_id', 'book', 'id', 'CASCADE');
        $this->addForeignKey('user_id', 'stat', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('book');
//        $this->dropTable('user');
        $this->dropTable('stat');
    }
}
