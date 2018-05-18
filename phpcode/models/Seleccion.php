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
 */
class Seleccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seleccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'categoria_id'], 'required'],
            [['categoria_id', 'session'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'apellido'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
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
        ];
    }
}
