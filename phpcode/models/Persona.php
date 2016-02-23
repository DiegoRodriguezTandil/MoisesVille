<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $mail
 * @property string $fechaNacimiento
 * @property string $domicilio
 * @property string $telefono
 * @property integer $ciudad_id
 *
 * @property Ingreso[] $ingresos
 * @property Ciudad $ciudad
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ciudad_id'], 'required'],
            [['id', 'ciudad_id'], 'integer'],
            [['fechaNacimiento'], 'safe'],
            [['nombre', 'apellido', 'domicilio'], 'string', 'max' => 100],
            [['mail'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 45]
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
            'apellido' => Yii::t('app', 'Apellido'),
            'mail' => Yii::t('app', 'Mail'),
            'fechaNacimiento' => Yii::t('app', 'Fecha Nacimiento'),
            'domicilio' => Yii::t('app', 'Domicilio'),
            'telefono' => Yii::t('app', 'Telefono'),
            'localidad_id' => Yii::t('app', 'Localidad'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngresos()
    {
        return $this->hasMany(Ingreso::className(), ['persona_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['id' => 'ciudad_id']);
    }
}
