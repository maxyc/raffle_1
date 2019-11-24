<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entities}}`.
 */
class m191124_111724_create_entity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%entity}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull(),
            'in_stock'=>$this->smallInteger()->defaultValue(0)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%entity}}');
    }
}
