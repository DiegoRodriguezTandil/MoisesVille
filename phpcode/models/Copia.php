<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "copia".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Acervo[] $acervos
 */
class Copia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'copia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
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
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['copia_id' => 'id']);
    }
}
