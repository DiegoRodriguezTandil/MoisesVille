<?php

use yii\db\Migration;

/**
 * Class m180518_120100_tabla_importacion
 */
class m180518_120100_tabla_importacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('importacion', [
            'id' => $this->primaryKey(),
            'descripcion' => $this->string()->notNull(),  
            'categoria_id' => $this->integer()->notNull(), 
            'fecha'=> $this->dateTime(),         
        ]);

        $this->addForeignKey(
            'fk_importacion_categoria',
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
        $this->delete('importacion');
        $this->dropTable('importacion');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180518_120100_tabla_importacion cannot be reverted.\n";

        return false;
    }
    */
}
