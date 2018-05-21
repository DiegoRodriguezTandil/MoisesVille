<?php
namespace app\controllers;


use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use app\models\Categoria;
use app\models\Importacion;

    
    
    class DatosGenealogicosController extends MainController{
        
        public function actionIndex(){
    
            $mongodb = Yii::$app->mongodb;
            
            $collection = $mongodb->getCollection('Acervo');
            $datos = $collection->find([]);
    
            $html = $this->renderAjax('resultadosBusqueda', ['dataProvider' => $this->createMongoDataProvider($datos)]);
            
            return $this->render('index',['html' => $html ]);
        }
        
        public function actionImportacion(){
            $modelImportacion = new Importacion();
            if (!empty(Yii::$app->request->post())){ //Si me hacen un llamado post importo el excel a mi Mongodb
                $modelImportacion->load(Yii::$app->request->post()); //Guardo los datos ingresados por el usuario
                $modelImportacion->save();
                $excelRows = $this->getExcelRows($modelImportacion);
                $collectionName = $modelImportacion->getNombreCategoria();
                if  (!empty($collectionName)){
                    $mongodb = Yii::$app->mongodb;
                    $collection = $mongodb->getCollection($collectionName);
                    $first = true;
                    foreach ($excelRows as $excelRow){
                        $excelRow['importacion_id'] = $modelImportacion->id;
                        $collection->insert($excelRow);
                    }
                    $documentos = $collection->find(['importacion_id' => $modelImportacion->id]);
                    $html = $this->renderAjax('importPreview',['documentos' => $documentos,'importacion_id' => $modelImportacion->id , 'dataProvider' => $this->createMongoDataProvider($documentos)]);
                    return $this->render('indexImportacion',[
                        'modelImportacion' => $modelImportacion,
                        'html' => $html
                    ]);
                }
            }else{ //Si me hacen un llamado get renderizo la pantalla
                return $this->render('indexImportacion',['modelImportacion' => $modelImportacion]);
            }
        }
        
        public function actionEnviarMail(){
            return $this->render('mandarMail');
        }
        
        public function actionBuscar(){
            $searchFeld = Yii::$app->request->get('q');
            $collectionID = Yii::$app->request->get('id');
            
            try{
                if (!empty($collectionID)){
                    $collectionName = Categoria::find()->where(['id' => $collectionID])->one();
                    if (!empty($collectionName)){
                        $mongodb = Yii::$app->mongodb;
                        $collection = $mongodb->getCollection($collectionName->descripcion);
                        $filter = ['like' ,'Nombre' , $searchFeld];
                        if  (!empty($collection)){
                            if (!empty($collection->count($filter))){
                                $datos = $collection->find($filter);
                                $html = $this->renderAjax('resultadosBusqueda', ['dataProvider' => $this->createMongoDataProvider($datos)]);
                                $response = ["result" => "ok", "mensaje" => "Se encontraron resultados en {$collectionName->descripcion}", 'info' => $html ];
                            }else{
                                $html = $this->renderAjax('resultadosBusqueda', ['mensaje' => 'No se encontraron datos en la busqueda']);
                                $response = ["result" => "error", "mensaje" => "No se encontraron resultados en {$collectionName->descripcion}", 'info' => $html ];
                            }
                           
                        }else{
                            throw new Exception('No se encontraron datos en '.$collectionName->descripcion);
                        }
                    }else{
                        throw new Exception('No se encontro una categoria con ese id ');
                    }
                }else{
                    throw new Exception('No llego el id de la categoria');
                }
            }catch (Exception $e){
                $response = ["result" => "error", "mensaje" => $e->getMessage()];
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }
        
        //Guardo archivo subido y obtengo todas las tupls del excel, para despues guardarlas en la mongodb
        private function getExcelRows($model){
            $excelRows = null;
            $Excel = UploadedFile::getInstances($model,'excelFile');
            $Excel = $Excel[0];
            $fileName = $this->changeFileName($Excel->name);
            $path =   Yii::getAlias('@webroot').'/ExcelFiles/'.$fileName;
            
            if  ($Excel->saveAs($path,true)){
                $excelRows = \moonland\phpexcel\Excel::import($path);
            }
            
            return $excelRows[0];
        }
        
        private function changeFileName($fileName){
            $nameOfFile = explode(".", $fileName);
            $ext = end($nameOfFile);
            $fecha = new \DateTime();
            $filename = "{$fecha->getTimestamp()}.{$ext}";
            return  $filename;
        }
        
        public function actionCancelarImportacion(){
            $response = ['rta'=>'error', 'message'=> 'No se pudo cancelar la importacion'];
            $import_id = Yii::$app->request->get('id');
            if (!empty($import_id)){
                $importacion = Importacion::find()->where(['id' => $import_id])->one();
                $collectionName = $importacion->getNombreCategoria();
                $mongodb = Yii::$app->mongodb;
                $collection = $mongodb->getCollection($collectionName);
                $documentos = $collection->find(['importacion_id' => (int) $import_id ]);
                
                foreach ($documentos as $documento){
                    $collection->remove(['_id' => $documento['_id']]);
                }
                $response = ['rta'=>'ok', 'message'=>'Se cancelo lo importacion correctamente'];
            }
    
           \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           return $response;
        }
        
        private function createMongoDataProvider($documents){ //Creo un Data Provider para un gridview
            $arr = [];
            $colums = [];
            $columnas = [];
            foreach ($documents as $document) {
                if (empty($colums))
                    $colums = array_keys($document);
                $arr[] = $document;
            }
            foreach ($colums as $colum){
                if ($colum == '_id'){
                    $columnas[] = [
                        'attribute' => $colum,
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::checkbox('checkbox', false ,['class' => 'agreement', 'value' => $data['_id']]);
                        }
                    ];
                }else if ($colum != 'importacion_id'){
                    $columnas[] = [  'attribute' => $colum ];
                }else {
                    $columnas[] = [
                        'attribute' => $colum,
                        'label' => 'Detalle',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a("<i class='fa fa-eye'></i>", null,[
                                    'title' => Yii::t('app', 'Detalle'),
                                    'class'=>'btn btn-info btn-xs',
                                ]);
                        },
                    ];
                }
                
            }
            
            $provider = new ArrayDataProvider([
                'allModels' => $arr,
                'pagination' => [
                    'pageSize' => 150,
                ],
                'sort' => [
                    'attributes' => $colums,
                ],
            ]);
            
            return ['dataProvider' => $provider, 'columns' => $columnas ];
        }
    
    
    }