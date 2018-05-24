<?php

use yii\db\Migration;

/**
 * Class m180522_140658_alterSeleccion
 */
class m180522_140658_alterSeleccion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('seleccion', 'documento_id',  $this->string()->notNull());
        $this->alterColumn('seleccion', 'apellido',  $this->string());
        $this->alterColumn('seleccion', 'fecha',  $this->datetime()->notNull()->defaultValue('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180522_140658_alterSeleccion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_140658_alterSeleccion cannot be reverted.\n";

        return false;
    }
    */
}
