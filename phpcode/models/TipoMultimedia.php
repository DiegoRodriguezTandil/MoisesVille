<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoMultimedia".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Multimedia[] $multimedia
 */
class TipoMultimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoMultimedia';
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
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['tipoMultimedia_id' => 'id']);
    }
}
