<?php

namespace app\controllers;

use Yii;
use app\models\Ingreso;
use app\models\IngresoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;

/**
 * IngresoController implements the CRUD actions for Ingreso model.
 */
class IngresoController extends MainController
{
    
    const USER_SAVE_INGRESO = "btnUserSaveIngreso";
    const NEW_OBJECT = "btnNewObject";
    const NEW_PERSONA = "btnNewPersona";
    
    public function behaviors()
    {
        return array_merge(
                parent::behaviors(),
                [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['post'],
                        ],
                    ],
                ]
            );
    }

    /**
     * Lists all Ingreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngresoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingreso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $m = $this->findModel($id);
        $acervos = $this->getObjectsProvider($m);
        return $this->render('view_detail', [
            'model' => $m,
            'acervos' => $acervos,
        ]);
    }
    
    public function actionDetail($id)
    {
        $m = $this->findModel($id);
        $acervos = $this->getObjectsProvider($m);
        return $this->render('view_detail', [
            'model' => $m,
            'acervos' => $acervos,
        ]);
    }
    
    public function actionPrint($id)
    {
        $m = $this->findModel($id);
        $acervos = $this->getObjectsProvider($m);
//        return $this->render('print', [
//            'model' => $m,
//            'acervos' => $acervos,
//        ]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '* {font-size:14px}', 
             // set mPDF properties on the fly

            'content' => $this->renderPartial('print', [
                             //   'searchModel' => $searchModel,
                                'model' => $m, 
                                'acervos' => $acervos,      
                            ]),
            'options' => [
                'title' => 'Ingreso',
                'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Gestión de Colecciones -' . date("d-M-y")],
                'SetFooter' => ['|Página {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }
    
    private function getObjectsProvider($model){
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getAcervos(),
        ]);            
        return $dataProvider;
    }
    
    private function saveNewOrUpdateIngreso($id)
    {
        if (
                $id
                && (Yii::$app->request->post('action')==self::USER_SAVE_INGRESO)
        ) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())){
                $model->autoSave = 'N'; 
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }            
            return $this->render('create', [
                'model' => $model,
                'btnSave' => self::USER_SAVE_INGRESO,
                'btnNewObject' => self::NEW_OBJECT,
                'btnNewPersona'=> self::NEW_PERSONA,
                'dataObject'=>$this->getObjectsProvider($model),                                
            ]);                                       
        }

        if (
                $id
                && (Yii::$app->request->post('action')==self::NEW_OBJECT)
        ) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/acervo/addingreso', 'ingreso_id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'btnSave' => self::USER_SAVE_INGRESO,
                    'btnNewObject' => self::NEW_OBJECT,
                    'btnNewPersona'=> self::NEW_PERSONA,
                    'dataObject'=>$this->getObjectsProvider($model),                                    
                ]);                
            }            
        }

        if (
                $id
                && (Yii::$app->request->post('action')==self::NEW_PERSONA)
        ) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/persona/addingreso', 'ingreso_id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                    'btnSave' => self::USER_SAVE_INGRESO,
                    'btnNewObject' => self::NEW_OBJECT,
                    'btnNewPersona'=> self::NEW_PERSONA,
                    'dataObject'=>$this->getObjectsProvider($model),                
                ]);                
            }            
        }        
    }

    /**
     * Creates a new Ingreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $id = Yii::$app->request->post('id');
        
        if (!$id) {
            $model = new Ingreso();
            $model->user_id = \Yii::$app->user->identity->id;
            $model->autoSave = 'S';
            $model->save();
            return $this->render('create', [
                'model' => $model,
                'btnSave' => self::USER_SAVE_INGRESO,
                'btnNewObject' => self::NEW_OBJECT,
                'btnNewPersona'=> self::NEW_PERSONA,
                'dataObject'=>$this->getObjectsProvider($model),                
            ]);
        } 
        
        return $this->saveNewOrUpdateIngreso($id);

    }

    /**
     * Updates an existing Ingreso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if($id && !Yii::$app->request->post('action')){
            return $this->render('update', [
                'model' => $model,
                'btnSave' => self::USER_SAVE_INGRESO,
                'btnNewObject' => self::NEW_OBJECT,
                'btnNewPersona'=> self::NEW_PERSONA,     
                'dataObject'=>$this->getObjectsProvider($model),
            ]);            
        }
        
        return $this->saveNewOrUpdateIngreso($id);
       
    }
    
    /**
     * Deletes an existing Ingreso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            if($this->findModel($id)->delete()){
                return $this->redirect(['index']);
            }
        } catch (\yii\db\IntegrityException $exc) {
            Yii::$app->session->setFlash('error',
                [
                    //'type' => 'error',
                    'icon' => 'fa fa-users',
                    'message' => 'Ingreso posee elementos dependientes',
                    'title' => 'Error de Borrado',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );
            return $this->redirect(['view','id'=>$id]);
        }
    }

    /**
     * Finds the Ingreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingreso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
