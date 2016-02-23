<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acervo".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $nroInventario
 * @property string $forma
 * @property string $material
 * @property integer $tema_id
 * @property integer $tipoAcervo_id
 * @property string $ancho
 * @property string $largo
 * @property string $alto
 * @property integer $unidadMedida_id
 * @property string $peso
 * @property integer $unidadPeso_id
 * @property string $diametroInterno
 * @property string $diametroExterno
 * @property string $fechaIngreso
 * @property integer $ingreso_id
 * @property integer $coleccion_id
 * @property string $publicar_id
 * @property Coleccion $coleccion
 * @property Publicar $publicar
 * @property UnidadMedida $unidadMedida
 * @property UnidadPeso $unidadPeso
 * @property Ingreso $ingreso
 * @property Tema $tema
 * @property TipoAcervo $tipoAcervo
 * @property Multimedia[] $multimedia
 */
class Acervo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acervo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['tema_id', 'coleccion_id'], 'required'],
            [['tema_id', 'tipoAcervo_id', 'unidadMedida_id', 'unidadPeso_id', 'ingreso_id', 'coleccion_id'], 'integer'],
            [['ancho', 'largo', 'alto', 'peso', 'diametroInterno', 'diametroExterno'], 'number'],
            [['fechaIngreso'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['nroInventario'], 'string', 'max' => 45],
            [['forma', 'material'], 'string', 'max' => 100],
            [['publicar_id'], 'string', 'max' => 2]
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
            'descripcion' => Yii::t('app', 'Descripción'),
            'nroInventario' => Yii::t('app', 'Nro Inventario'),
            'forma' => Yii::t('app', 'Forma'),
            'material' => Yii::t('app', 'Material'),
            'tema_id' => Yii::t('app', 'Tema ID'),
            'tipoAcervo_id' => Yii::t('app', 'Tipo Acervo ID'),
            'ancho' => Yii::t('app', 'Ancho'),
            'largo' => Yii::t('app', 'Largo'),
            'alto' => Yii::t('app', 'Alto'),
            'unidadMedida_id' => Yii::t('app', 'Unidad Medida ID'),
            'peso' => Yii::t('app', 'Peso'),
            'unidadPeso_id' => Yii::t('app', 'Unidad Peso ID'),
            'diametroInterno' => Yii::t('app', 'Diametro Interno'),
            'diametroExterno' => Yii::t('app', 'Diametro Externo'),
            'fechaIngreso' => Yii::t('app', 'Fecha Ingreso'),
            'ingreso_id' => Yii::t('app', 'Ingreso ID'),
            'coleccion_id' => Yii::t('app', 'Coleccion ID'),
            'publicar_id' => Yii::t('app', 'Publicar ID'),
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidadMedida_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadPeso()
    {
        return $this->hasOne(UnidadPeso::className(), ['id' => 'unidadPeso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngreso()
    {
        return $this->hasOne(Ingreso::className(), ['id' => 'ingreso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColeccion()
    {
        return $this->hasOne(Coleccion::className(), ['id' => 'coleccion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicar()
    {
        return $this->hasOne(Publicar::className(), ['id' => 'publicar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['objetos_id' => 'id']);
    }
}
