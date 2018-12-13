<?php

use yii\db\Migration;

/**
 * Class m181212_105407_create_calendar_tables
 */
class m181212_105407_create_calendar_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // создаём таблицу событий
        $this->createTable('events', [
        'id_events' => $this->primaryKey(),
        'title' => $this->string(255)->notNull(),
        'startDay' => $this->timestamp()->defaultExpression("now()"),
        'endDay' => $this->timestamp()->defaultExpression("now()"),
        'id_user' => $this->integer()->notNull(),
        'description' => $this->text()->notNull(),
        'isBlock' => $this->boolean()->defaultExpression("false")
        ]);

        // создаём таблицу пользователей
        $this->createTable('users', [
        'id_users' => $this->primaryKey(),
        'user_name' => $this->string(255)->notNull(),
        'password' => $this->text()->notNull()
        ]);

        //создаём таблицу связки пользователей и событий
        $this->createTable('events_users', [
        'id_events_users' => $this->primaryKey(),
        'id_user' => $this->integer()->notNull(),
        'id_event' => $this->integer()
        ]);
        
        // создаём внешний ключ для поля id_user в таблице events
        $this->addForeignKey('foreign_key_events', 'events', 'id_user', 'users', 'id_users', 'cascade');
        // создаём внешний ключ для поля id_user в таблице events_users
        $this->addForeignKey('foreign_key_events_users1', 'events_users', 'id_user', 'users', 'id_users', 'cascade');
        // создаём внешний ключ для поля id_event в таблице events_users
        $this->addForeignKey('foreign_key_events_users2', 'events_users', 'id_event', 'events', 'id_events', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this -> dropTable('events_users');
        $this -> dropTable('events');
        $this -> dropTable('users');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181212_105407_create_calendar_tables cannot be reverted.\n";

        return false;
    }
    */
}
