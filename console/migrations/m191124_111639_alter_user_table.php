<?php

use yii\db\Migration;

/**
 * Class m191124_111639_alter_user_table
 */
class m191124_111639_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'balls', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'balls');
    }
}
