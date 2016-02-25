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
 * @property integer $localidad_id
 * @property integer $flia
 *
 * @property Ingreso[] $ingresos
 * @property Localidad $localidad
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
            [['fechaNacimiento'], 'safe'],
            [['localidad_id', 'flia'], 'integer'],
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
            'flia' => Yii::t('app', 'Flia'),
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
    public function getLocalidad()
    {
        return $this->hasOne(Localidad::className(), ['id' => 'localidad_id']);
    }

    /**
     * @inheritdoc
     * @return PersonaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaQuery(get_called_class());
    }
}
