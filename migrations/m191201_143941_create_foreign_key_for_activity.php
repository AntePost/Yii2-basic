<?php

use yii\db\Migration;

/**
 * Class m191201_143941_create_foreign_key_for_activity
 */
class m191201_143941_create_foreign_key_for_activity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_activity_users_user_id', 'activity', 'author_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_activity_users_user_id', 'activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191201_143941_create_foreign_key_for_activity cannot be reverted.\n";

        return false;
    }
    */
}
