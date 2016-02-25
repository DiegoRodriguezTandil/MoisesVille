<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "formaIngreso".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Ingreso[] $ingresos
 */
class FormaIngreso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formaIngreso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresos()
    {
        return $this->hasMany(Ingreso::className(), ['formaIngreso_id' => 'id']);
    }
}
