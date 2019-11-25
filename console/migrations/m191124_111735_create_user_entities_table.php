<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_entities}}`.
 */
class m191124_111735_create_user_entities_table extends Migration
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

        $this->createTable('{{%user_entities}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'status'=>$this->tinyInteger()->defaultValue(0)->notNull(),
            'status_delivery'=>$this->tinyInteger()->defaultValue(0)->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_user_entities_user_id', '{{%user_entities}}', 'user_id');
        $this->createIndex('idx_user_entities_entity_id', '{{%user_entities}}', 'entity_id');

        $this->addForeignKey('fk_idx_user_entities_user_id', '{{%user_entities}}', 'user_id',
                             '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_idx_user_entities_entity_id', '{{%user_entities}}', 'entity_id',
            '{{%entity}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_idx_user_entities_user_id', '{{%user_entities}}');
        $this->dropForeignKey('fk_idx_user_entities_entity_id', '{{%user_entities}}');

        $this->dropTable('{{%user_entities}}');
    }
}
