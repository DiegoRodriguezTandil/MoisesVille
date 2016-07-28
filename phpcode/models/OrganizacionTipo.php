<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organizacionTipo".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property Organizacion[] $organizacions
 */
class OrganizacionTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organizacionTipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['descripcion'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
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
    public function getOrganizacions()
    {
        return $this->hasMany(Organizacion::className(), ['organizacionTipo_id' => 'id']);
    }
}
