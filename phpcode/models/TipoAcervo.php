<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoAcervo".
 *
 * @property integer $id
 * @property string $descripcion
 * @property integer $tipoAcervo_id
 *
 * @property Objetos[] $objetos
 * @property TipoAcervo $tipoAcervo
 * @property TipoAcervo[] $tipoAcervos
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
            [['tipoAcervo_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'tipoAcervo_id' => 'Tipo Acervo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objetos::className(), ['tipoAcervo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAcervo()
    {
        return $this->hasOne(TipoAcervo::className(), ['id' => 'tipoAcervo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAcervos()
    {
        return $this->hasMany(TipoAcervo::className(), ['tipoAcervo_id' => 'id']);
    }
}
