<?php

namespace app\controllers;

use Yii;
use app\models\Acervo;
use app\models\Multimedia;
use app\models\AcervoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller; 

/**
 * AcervoController implements the CRUD actions for Acervo model.
 */
class AcervoController extends Controller
{
    
    public function behaviors()
    {
        return [
                   'verbs' => [
                       'class' => VerbFilter::className(),
                       'actions' => [
                           'delete' => ['post'],
                       ],
                   ],
               ];
    }

    /**
     * Lists all Acervo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcervoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
       //     'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acervo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        $multimedia = new Multimedia();
        return $this->render('view', [
            'model' => $model, 'multimedia' => $multimedia
        ]);
    }
    
    /**
     * Displays a single Acervo model with images
     * @param integer $id
     * @return mixed
     */
    public function actionIngreso($id)
    {   
        $model = $this->findModel($id);
        $multimedia = new Multimedia();
        $m = $model->load(Yii::$app->request->post());
        if ($m){
            if  ($model->save()) {
                    $fotos = $multimedia->load(Yii::$app->request->post('Multimedia'));
                    if  ($fotos->save())
                        return $this->redirect(['ingreso', 'id' => $model->id]);
           }
        }
        else {
            return $this->render('ingreso', [
            'model' => $model, 'multimedia' => $multimedia]);
        }
    }

    /**
     * Creates a new Acervo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acervo();
        $m = $model->load(Yii::$app->request->post());
        $s = $model->save();
        if ($m && $s) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Acervo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {            
            if  ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {            
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    public function actionUpdateIngreso($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ingreso/update', 'id' => $model->ingreso_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Deletes an existing Acervo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Acervo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acervo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acervo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddingreso($ingreso_id){
        $model = new Acervo();
        if(isset($ingreso_id)){
            $model->ingreso_id = $ingreso_id;
        }
        $m = $model->load(Yii::$app->request->post());
        if ($m && $model->save()) {
            return $this->redirect(['/ingreso/update', 'id' => $model->ingreso_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }        
    }
    
    /*public function beforeSave() 
    {
        if ($this->isNewRecord)
               Yii::app()->dateFormatter->format("yyyy-mm-dd",$this->fechaIngreso);
        return parent::beforeSave();
    }*/
}
