<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_balls}}`.
 */
class m191124_112118_create_user_balls_table extends Migration
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

        $this->createTable('{{%user_balls}}', [
            'user_id' => $this->integer()->notNull(),
            'value'=>$this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('idx_user_balls_user_id', '{{%user_balls}}', 'user_id');
        $this->addForeignKey('fk_idx_user_balls_user_id', '{{%user_balls}}', 'user_id',
                             '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_idx_user_balls_user_id', '{{%user_balls}}');
        $this->dropTable('{{%user_balls}}');
    }
}
