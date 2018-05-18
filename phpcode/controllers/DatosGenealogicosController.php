<?php
namespace app\controllers;
use Yii;
use app\models\Coleccion;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\mongodb\Query;
    
    
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
            
            return $this->render('index',['datos' => $collection->find(['like' ,'nombre' , 'Agusti']) ]);
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
            $searchFeld = 'Agusti';
            $collectionName = Yii::$app->request->get('id');
    
            $mongodb = Yii::$app->mongodb;
            $collection = $mongodb->getCollection($collectionName);
            $datos = $collection->find(['like' ,'nombre' , 'Agusti']);
            
            $html = $this->renderAjax('resultadosBusqueda', ['datos' => $datos]);
            $response = ["result" => "ok", "mensaje" => "La busqueda se realizo correctamente", 'info' => $html ];
        }
    
    
    }