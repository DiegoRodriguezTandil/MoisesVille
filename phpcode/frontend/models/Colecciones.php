<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "colecciones".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Objetos[] $objetos
 */
class Colecciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'colecciones';
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
        return $this->hasMany(Objetos::className(), ['colecciones_id' => 'id']);
    }
}
