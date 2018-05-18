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
    
    
    }