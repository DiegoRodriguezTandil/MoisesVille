<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Seleccion[] $seleccions
 * @property Seleccion[] $seleccions0
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeleccions()
    {
        return $this->hasMany(Seleccion::className(), ['categoria_id' => 'id']);
    }
    
}
