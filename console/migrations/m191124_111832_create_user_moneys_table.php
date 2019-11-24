<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_money}}`.
 */
class m191124_111832_create_user_moneys_table extends Migration
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

        $this->createTable('{{%user_moneys}}', [
            'user_id' => $this->integer()->notNull(),
            'money'=>$this->integer()->notNull(),
            'status'=>$this->tinyInteger()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->createIndex('idx_user_moneys_user_id', '{{%user_moneys}}', 'user_id');
        $this->addForeignKey('fk_idx_user_moneys_user_id', '{{%user_moneys}}', 'user_id',
                             '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_idx_user_moneys_user_id', '{{%user_moneys}}');
        $this->dropTable('{{%user_moneys}}');
    }
}
