<?php

use yii\db\Migration;

/**
 * Class m180518_120051_tabla_seleccion
 */
class m180518_120051_tabla_seleccion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('seleccion', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),   
            'apellido' => $this->string()->notNull(),  
            'categoria_id' => $this->integer()->notNull(), 
            'fecha'=> $this->dateTime(),
            'session' => $this->integer(),          
        ]);

        $this->addForeignKey(
            'fk_seleccion_categoria',
            'seleccion',
            'categoria_id',
            'categoria',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('seleccion');
        $this->dropTable('seleccion');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180518_120051_tabla_seleccion cannot be reverted.\n";

        return false;
    }
    */
}
