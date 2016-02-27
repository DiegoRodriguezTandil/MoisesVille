<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "acervo".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $nroInventario
 * @property string $forma
 * @property string $material
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
 * @property integer $estado_id
 * @property integer $ubicacion_id
 * @property string $caracteristicas
 * @property string $lugarprocac
 * @property string $color
 * @property string $notas
 * @property string $fechaBaja
 * @property string $descEpoca
 * @property string $descUbicacion
 * @property string $nroA
 * @property string $nroB
 * @property string $nroC
 * @property string $nroD
 * @property integer $motivoBaja_id
 * @property integer $copia_id
 * @property integer $codformaing
 * @property integer $codtipoac
 * @property integer $clasifac
 * @property integer $publicar_id
 * @property integer $idold
 *
 * @property Copia $copia
 * @property Estado $estado
 * @property MotivoBaja $motivoBaja
 * @property Publicar $publicar
 * @property Ubicacion $ubicacion
 * @property UnidadMedida $unidadMedida
 * @property UnidadPeso $unidadPeso
 * @property Ingreso $ingreso
 * @property TipoAcervo $tipoAcervo
 * @property ColeccionAcervo[] $coleccionAcervos
 * @property Coleccion[] $coleccions
 * @property Multimedia[] $multimedia
 * @property TemaAcervo[] $temaAcervos
 * @property Tema[] $temas
 */
class Acervo extends \yii\db\ActiveRecord
{
    public $temaIds = [];
    public $coleccionIds = [];
    public $files;
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
            [['descripcion', 'caracteristicas', 'notas'], 'string'],
            [['tipoAcervo_id', 'unidadMedida_id', 'unidadPeso_id', 'ingreso_id', 'estado_id', 'ubicacion_id', 'motivoBaja_id', 'copia_id', 'codformaing', 'codtipoac', 'clasifac', 'publicar_id', 'idold'], 'integer'],
            [['ancho', 'largo', 'alto', 'peso', 'diametroInterno', 'diametroExterno'], 'number'],
            [['fechaIngreso', 'fechaBaja'], 'safe'],
            [['nombre', 'descEpoca', 'descUbicacion'], 'string', 'max' => 255],
            [['nroInventario', 'color', 'nroA', 'nroB', 'nroC', 'nroD'], 'string', 'max' => 45],
            [['forma', 'material', 'lugarprocac'], 'string', 'max' => 100]
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
            'tipoAcervo_id' => Yii::t('app', 'Tipo Acervo'),
            'ancho' => Yii::t('app', 'Ancho'),
            'largo' => Yii::t('app', 'Largo'),
            'alto' => Yii::t('app', 'Alto'),
            'unidadMedida_id' => Yii::t('app', 'Unidad Medida'),
            'peso' => Yii::t('app', 'Peso'),
            'unidadPeso_id' => Yii::t('app', 'Unidad Peso'),
            'diametroInterno' => Yii::t('app', 'Diámetro Interno'),
            'diametroExterno' => Yii::t('app', 'Diámetro Externo'),
            'fechaIngreso' => Yii::t('app', 'Fecha Ingreso'),
            'ingreso_id' => Yii::t('app', 'Ingreso'),
            'estado_id' => Yii::t('app', 'Estado'),
            'ubicacion_id' => Yii::t('app', 'Ubicación'),
            'caracteristicas' => Yii::t('app', 'Características'),
            'lugarprocac' => Yii::t('app', 'Lugar de Procedencia'),
            'color' => Yii::t('app', 'Color'),
            'notas' => Yii::t('app', 'Notas'),
            'fechaBaja' => Yii::t('app', 'Fecha Baja'),
            'descEpoca' => Yii::t('app', 'Descripción Epoca'),
            'descUbicacion' => Yii::t('app', 'Descripción Ubicación'),
            'nroA' => Yii::t('app', 'Nro A'),
            'nroB' => Yii::t('app', 'Nro B'),
            'nroC' => Yii::t('app', 'Nro C'),
            'nroD' => Yii::t('app', 'Nro D'),
            'motivoBaja_id' => Yii::t('app', 'Motivo Baja'),
            'copia_id' => Yii::t('app', 'Tipo de Copia'),
            'codformaing' => Yii::t('app', 'Forma Ingreso'),
            'codtipoac' => Yii::t('app', 'Codtipoac'),
            'clasifac' => Yii::t('app', 'Clasifac'),
            'publicar_id' => Yii::t('app', 'Publicar en Web'),
            'idold' => Yii::t('app', 'Idold'),            
            'TemaIds'=> Yii::t('app', 'Tema'),
            'ColeccionIds'=> Yii::t('app', 'Colección'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopia()
    {
        return $this->hasOne(Copia::className(), ['id' => 'copia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotivoBaja()
    {
        return $this->hasOne(MotivoBaja::className(), ['id' => 'motivoBaja_id']);
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
    public function getUbicacion()
    {
        return $this->hasOne(Ubicacion::className(), ['id' => 'ubicacion_id']);
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
    public function getUnidadMedidaDescripcion()
    {        
        $unidadmedida = $this->unidadMedida;
        if($unidadmedida){
            return $unidadmedida->descripcion;
        }
        return '(no definido)';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadPeso()
    {
        return $this->hasOne(UnidadPeso::className(), ['id' => 'unidadPeso_id']);
    }
    
    public function getUnidadPesoDescripcion()
    {        
        $unidadPeso = $this->unidadPeso;
        if($unidadPeso){
            return $unidadPeso->descripcion;
        }
        return '(no definido)';
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
    public function getTipoAcervo()
    {
        return $this->hasOne(TipoAcervo::className(), ['id' => 'tipoAcervo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColeccionAcervos()
    {
        return $this->hasMany(ColeccionAcervo::className(), ['acervo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColeccions()
    {
        return $this->hasMany(Coleccion::className(), ['id' => 'coleccion_id'])->viaTable('coleccion_acervo', ['acervo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['objetos_id' => 'id']);
    }
    
    public function getMultimediaDataProvider()
    {
        $dataProvider = new ActiveDataProvider([
      //  'query' => Multimedia::find()->where(['objetos_id'=>'id']),
            $this->multimedia
        ]);
        if ($dataProvider)
            return $dataProvider;
        else return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemaAcervos()
    {
        return $this->hasMany(TemaAcervo::className(), ['acervo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemas()
    {
        return $this->hasMany(Tema::className(), ['id' => 'tema_id'])->viaTable('tema_acervo', ['acervo_id' => 'id']);
    }
    
    //Llenado de taggin de Temas
     //para llenar Select2
    public function getAcervoHasTema()
    {
       return $this->hasOne(Tema_Acervo::className(), ['acervo_id' => 'id']);
    }
    
    // you need a getter for select2 dropdown
    public function getdropTema()
    {
        $data = Tema::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'nombre');
    }
    
    // You will need a getter for the current set o Acervo in this Tema
    public function getTemaIds()
        {
          $this->temaIds = \yii\helpers\ArrayHelper::getColumn(
            $this->getAcervoHasTema()->asArray()->all(), 'tema_id');
          return $this->temaIds;
    }
     
    //Llenado de taggin de Colecciones
     //para llenar Select2
    public function getAcervoHasColeccion()
    {
       return $this->hasOne(Coleccion_Acervo::className(), ['acervo_id' => 'id']);
    }
    
    // you need a getter for select2 dropdown
    public function getdropColeccion()
    {
        $data = Coleccion::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'nombre');
    }
    
    // You will need a getter for the current set o Acervo in this Tema
    public function getColeccionIds()
        {
          $this->coleccionIds = \yii\helpers\ArrayHelper::getColumn(
            $this->getAcervoHasColeccion()->asArray()->all(),
            'coleccion_id'
          );
          return $this->coleccionIds;
    }
    
    // You need to save the relations in BookHasAuthor table (adicional code for updates)
    public function afterSave($insert, $changedAttributes)
    {
       $actualTemas = [];
       $actualColecciones = [];
       $temaExists = 0; //for updates
       $coleccionExists = 0; //for updates

      
       if (isset(Yii::$app->request->post('Acervo')['TemaIds']))
            $nuevosTemas  = Yii::$app->request->post('Acervo')['TemaIds'];
       else $nuevosTemas = [];
       if (isset(Yii::$app->request->post('Acervo')['ColeccionIds']))
            $nuevasColecciones  = Yii::$app->request->post('Acervo')['ColeccionIds'];
       else $nuevasColecciones = [];
       
       if (($actualTemas = Tema_Acervo::find()
        ->andWhere("acervo_id = $this->id")
        ->asArray()
        ->all()) !== null) {
          $actualTemas = ArrayHelper::getColumn($actualTemas, 'tema_id');
          $temaExists = 1; // if there is authors relations, we will work it latter
       } 
       
       if ($temaExists == 1) { //delete colecciones y acervo 
            foreach ($actualTemas as $remove) {
              $r = Tema_Acervo::findOne(['tema_id' => $remove, 'acervo_id' => $this->id]);
              $r->delete();
            }
       }
            
        if (!empty($nuevosTemas)) { //save the relations
          foreach ($nuevosTemas as $id) {
            //$actualTemas = array_diff($nuevosTemas, [$id]); //remove remaining authors from array
            $r = new Tema_Acervo();
            $r->acervo_id = $this->id;
            $r->tema_id = $id;
            $r->save();
        }
        }
        
        if (($actualColecciones = Coleccion_Acervo::find()
        ->andWhere("acervo_id = $this->id")
        ->asArray()
        ->all()) !== null) {
          $actualColecciones = ArrayHelper::getColumn($actualColecciones, 'coleccion_id');
          $coleccionExists = 1; // if there is authors relations, we will work it latter
       } 
        if ($coleccionExists == 1) { //delete colecciones y acervo 
            foreach ($actualColecciones as $remove) {
              $r = Coleccion_Acervo::findOne(['coleccion_id' => $remove, 'acervo_id' => $this->id]);
              $r->delete();
            }
        }
       if (!empty($nuevasColecciones)) { //save the relations
          foreach ($nuevasColecciones as $id) {
            //$actualTemas = array_diff($nuevosTemas, [$id]); //remove remaining authors from array
            $r = new Coleccion_Acervo();
            $r->acervo_id = $this->id;
            $r->coleccion_id = $id;
            $r->save();
        }
       }     


       parent::afterSave($insert, $changedAttributes); //don't forget this
    }
  
}
