<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seleccion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $categoria_id
 * @property string $fecha
 * @property int $session
 * @property string $documento_id
 *
 * @property Categoria $categoria
 * @property Categoria $categoria0
 */
class Seleccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seleccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'categoria_id', 'session', 'documento_id'], 'required'],
            [['categoria_id'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'apellido','session'], 'string', 'max' => 255],
            [['documento_id'], 'string', 'max' => 100],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
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
            'apellido' => Yii::t('app', 'Apellido'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'session' => Yii::t('app', 'Session'),
            'documento_id' => Yii::t('app', 'Documento ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }
    
}
