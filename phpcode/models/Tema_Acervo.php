<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tema_acervo".
 *
 * @property integer $tema_id
 * @property integer $acervo_id
 *
 * @property Acervo $acervo
 * @property Tema $tema
 */
class Tema_Acervo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tema_acervo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tema_id', 'acervo_id'], 'required'],
            [['tema_id', 'acervo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tema_id' => Yii::t('app', 'Tema ID'),
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
    public function getTema()
    {
        return $this->hasOne(Tema::className(), ['id' => 'tema_id']);
    }
}
