<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipoAcervo".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Objetos[] $objetos
 */
class TipoAcervo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoAcervo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objetos::className(), ['tipoAcervo_id' => 'id']);
    }
}
