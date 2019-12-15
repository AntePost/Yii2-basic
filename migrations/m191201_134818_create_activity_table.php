<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m191201_134818_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
            'user_id' => $this->integer(),
            'description' => $this->string(1023),
            'is_repeatable' => $this->boolean(),
            'is_blocking' => $this->boolean(),
            'created_at' => $this->integer()->defaultExpression('now()'),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%activity}}');
    }
}
