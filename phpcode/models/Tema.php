<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tema".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property TemaAcervo[] $temaAcervos
 * @property Acervo[] $acervos
 */
class Tema extends \yii\db\ActiveRecord
{
    public $acervoIds = [];
 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tema';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 150]
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
    public function getTemaAcervos()
    {
        return $this->hasMany(TemaAcervo::className(), ['tema_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['id' => 'acervo_id'])->viaTable('tema_acervo', ['tema_id' => 'id']);
    }
    
    
    //para llenar Select2
    public function getTemaHasAcervo()
    {
       return $this->hasOne(Tema_Acervo::className(), ['tema_id' => 'id']);
    }
    
    // you need a getter for select2 dropdown
    public function getdropAcervo()
    {
        $data = Acervo::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'nombre');
    }
    
    // You will need a getter for the current set o Acervo in this Tema
    public function getAcervoIds()
        {
          $this->acervoIds = \yii\helpers\ArrayHelper::getColumn(
            $this->getTemaHasAcervo()->asArray()->all(),
            'acervo_id'
          );
          return $this->acervoIds;
     }
}

