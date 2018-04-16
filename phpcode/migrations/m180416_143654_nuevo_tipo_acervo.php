<?php

use yii\db\Migration;

/**
 * Class m180416_143654_nuevo_tipo_acervo
 */
class m180416_143654_nuevo_tipo_acervo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('tipoAcervo', [
            'descripcion' => 'Publicacion',
            'tipoAcervo_id' => 1,
            'cod' => 1,
            'clasifac' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180416_143654_nuevo_tipo_acervo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180416_143654_nuevo_tipo_acervo cannot be reverted.\n";

        return false;
    }
    */
}
