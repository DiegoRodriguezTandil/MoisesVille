<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubicacionExterna".
 *
 * @property integer $id
 * @property string $fechaInicio
 * @property string $fechaCierre
 * @property string $ubicacion
 * @property integer $acervo_id
 *
 * @property Acervo $acervo
 */
class UbicacionExterna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubicacionExterna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            
            [['acervo_id'], 'required'],
            [['acervo_id'], 'integer'],
            [['fechaInicio'], 'safe'],
            [['ubicacion'], 'string', 'max' => 255],
             [['fechaCierre'], 'compare', 'compareAttribute'=>'fechaInicio', 'operator'=>'>=','skipOnEmpty'=>true],   

              

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fechaInicio' => Yii::t('app', 'Fecha Inicio'),
            'fechaCierre' => Yii::t('app', 'Fecha Cierre'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
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
}
