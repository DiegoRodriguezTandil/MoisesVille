<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\mongodb\Query;
use app\models\Categoria;
    
    
    class DatosGenealogicosController extends MainController{
        
        public function actionIndex(){
    
            $mongodb = Yii::$app->mongodb;
            
            $collection = $mongodb->getCollection('Acervo');
    
            //ejemplo de insert
            // $collection->insert(['name' => 'John Smith', 'status' => 1]);
            
            
            //ejemplo de find
            // $collection->find(); //Lo recorro con un foreach
            //  $collection->find(['name' => 'John Smith']) //Busqueda con filtrado
            //  $collection->find(['like' ,'name' , 'John'])  //Busqueda con filtrado
    
            $html = $this->renderAjax('resultadosBusqueda', ['cursor' => $collection->find(['like' ,'nombre' , 'Agusti'])]);
            
            return $this->render('index',['html' => $html ]);
        }
        
        public function actionImportacion(){
    
            if (!empty(Yii::$app->request->post())){
            //Si me hacen un llamado post importo el excel a mi Mongodb
                $fileName = Yii::$app->request->post('file');
                $data = \moonland\phpexcel\Excel::import($fileName);
            }else{
                //Si me hacen un llamado get renderizo la pantalla
                return $this->render('indexImportacion');
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
                        $filter = ['like' ,'nombre' , $searchFeld];
                        if  (!empty($collection)){
                            if (!empty($collection->count($filter))){
                                $datos = $collection->find($filter);
                                $html = $this->renderAjax('resultadosBusqueda', ['cursor' => $datos]);
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
    
    
    }