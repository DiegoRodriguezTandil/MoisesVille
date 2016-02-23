<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidad".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $departamento_id
 *
 * @property Departamento $departamento
 * @property Persona[] $personas
 */
class Localidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'localidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'departamento_id'], 'required'],
            [['id', 'departamento_id'], 'integer'],
            [['nombre'], 'string', 'max' => 100]
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
            'departamento_id' => Yii::t('app', 'Departamento ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id' => 'departamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['localidad_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LocalidadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalidadQuery(get_called_class());
    }
}
