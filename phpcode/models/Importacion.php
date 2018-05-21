<?php

namespace app\models;

use Yii;
use app\models\Categoria;

/**
 * This is the model class for table "importacion".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $categoria_id
 * @property string $fecha
 */
class Importacion extends \yii\db\ActiveRecord
{
    public $excelFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'importacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'categoria_id'], 'required'],
            [['categoria_id'], 'integer'],
            [['fecha'], 'safe'],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }
    
    public function getNombreCategoria(){
        $response = null;
        $Categoria =  Categoria::find()->select('descripcion')->where(['id' => $this->categoria_id ])->one();
        if (!empty($Categoria->descripcion)){
            $response = $Categoria->descripcion;
        }
        return $response;
    }
}
