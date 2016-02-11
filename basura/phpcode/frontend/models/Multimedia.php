<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "multimedia".
 *
 * @property integer $id
 * @property string $path
 * @property string $webPath
 * @property integer $tipoMultimedia_id
 * @property integer $objetos_id
 *
 * @property Objetos $objetos
 * @property TipoMultimedia $tipoMultimedia
 */
class Multimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'multimedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoMultimedia_id', 'objetos_id'], 'required'],
            [['tipoMultimedia_id', 'objetos_id'], 'integer'],
            [['path', 'webPath'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'webPath' => 'Web Path',
            'tipoMultimedia_id' => 'Tipo Multimedia ID',
            'objetos_id' => 'Objetos ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasOne(Objetos::className(), ['id' => 'objetos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMultimedia()
    {
        return $this->hasOne(TipoMultimedia::className(), ['id' => 'tipoMultimedia_id']);
    }
}
