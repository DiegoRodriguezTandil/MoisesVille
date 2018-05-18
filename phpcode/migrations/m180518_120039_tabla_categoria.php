<?php

use yii\db\Migration;

/**
 * Class m180518_120039_tabla_categoria
 */
class m180518_120039_tabla_categoria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categoria', [
            'id' => $this->primaryKey(),
            'descripcion' => $this->string()->notNull(),            
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('categoria');
        $this->dropTable('categoria');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180518_120039_tabla_categoria cannot be reverted.\n";

        return false;
    }
    */
}
