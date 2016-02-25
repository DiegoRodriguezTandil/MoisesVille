<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coleccion_acervo".
 *
 * @property integer $coleccion_id
 * @property integer $acervo_id
 *
 * @property Acervo $acervo
 * @property Coleccion $coleccion
 */
class Coleccion_Acervo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coleccion_acervo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coleccion_id', 'acervo_id'], 'required'],
            [['coleccion_id', 'acervo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coleccion_id' => Yii::t('app', 'Coleccion ID'),
            'acervo_id' => Yii::t('app', 'Acervo ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervo()
    {
        return $this->hasOne(Acervo::className(), ['id' => 'acervo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColeccion()
    {
        return $this->hasOne(Coleccion::className(), ['id' => 'coleccion_id']);
    }
}
