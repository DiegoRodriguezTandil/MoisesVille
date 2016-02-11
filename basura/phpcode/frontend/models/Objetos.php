<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "objetos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $nroInventario
 * @property string $forma
 * @property string $material
 * @property integer $colecciones_id
 * @property integer $tema_id
 * @property integer $tipoAcervo_id
 * @property integer $ancho
 * @property integer $largo
 * @property integer $alto
 * @property integer $peso
 * @property integer $diametroInterno
 * @property integer $diametroExterno
 * @property string $fechaIngreso
 *
 * @property Multimedia[] $multimedia
 * @property Colecciones $colecciones
 * @property Tema $tema
 * @property TipoAcervo $tipoAcervo
 */
class Objetos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['colecciones_id', 'tema_id', 'tipoAcervo_id'], 'required'],
            [['colecciones_id', 'tema_id', 'tipoAcervo_id', 'ancho', 'largo', 'alto', 'peso', 'diametroInterno', 'diametroExterno'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['nroInventario', 'fechaIngreso'], 'string', 'max' => 45],
            [['forma', 'material'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'nroInventario' => 'Nro Inventario',
            'forma' => 'Forma',
            'material' => 'Material',
            'colecciones_id' => 'Colecciones ID',
            'tema_id' => 'Tema ID',
            'tipoAcervo_id' => 'Tipo Acervo ID',
            'ancho' => 'Ancho',
            'largo' => 'Largo',
            'alto' => 'Alto',
            'peso' => 'Peso',
            'diametroInterno' => 'Diametro Interno',
            'diametroExterno' => 'Diametro Externo',
            'fechaIngreso' => 'Fecha Ingreso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['objetos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColecciones()
    {
        return $this->hasOne(Colecciones::className(), ['id' => 'colecciones_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTema()
    {
        return $this->hasOne(Tema::className(), ['id' => 'tema_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAcervo()
    {
        return $this->hasOne(TipoAcervo::className(), ['id' => 'tipoAcervo_id']);
    }
}
