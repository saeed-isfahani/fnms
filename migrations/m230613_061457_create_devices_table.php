<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%devices}}`.
 */
class m230613_061457_create_devices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%devices}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->text()->notNull(),
            'mac' => $this->text()->notNull(),
            'name' => $this->text()->notNull(),
            'ports' => $this->text()->notNull(),
            'scan_series' => $this->integer()->notNull(),
            'create_at' => $this->timestamp()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%devices}}');
    }
}
