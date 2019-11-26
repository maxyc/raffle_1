<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%options}}`.
 */
class m191124_111757_create_option_table extends Migration
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
        $this->createTable(
            '{{%option}}',
            [
                'key' => $this->string(50)->notNull(),
                'value' => $this->string(50)->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('pk_option_key', '{{%option}}', 'key');

        $this->batchInsert(
            '{{%option}}',
            ['key', 'value'],
            [
                ['money', 9999],
                ['percent', 30],
                ['coefficient', 30]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%option}}');
    }
}
