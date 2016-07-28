<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clasificacionGenerica".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Acervo[] $acervos
 */
class ClasificacionGenerica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clasificacionGenerica';
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
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['clasificacionGenerica_id' => 'id']);
    }
}
