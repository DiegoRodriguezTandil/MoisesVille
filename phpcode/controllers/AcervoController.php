<?php

namespace app\controllers;

use Yii;
use app\models\Acervo;
use app\models\Multimedia;
use yii\data\ArrayDataProvider;
use app\models\AcervoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AcervoController implements the CRUD actions for Acervo model.
 */
class AcervoController extends MainController
{
    
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
    
    public $files = [];
    
    /**
     * Lists all Acervo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcervoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        $multimediaProvider = new ArrayDataProvider([
            'allModels' => Multimedia::findAll(['objetos_id'=>$model->id]),
        ]);
        return $this->render('view', [
            'model' => $model, 
            'dataProvider' => $multimediaProvider,            
        ]);
    }
    
    private function saveUbicacionExterna($acervo_id, $values){
        if(isset($values['ubicacion']))
        {
            $ue = new \app\models\UbicacionExterna();
            $ue->acervo_id = $acervo_id;
            $ue->fechaInicio = $values['fechaInicio'];
            $ue->fechaCierre = $values['fechaCierre'];
            $ue->ubicacion = $values['ubicacion'];
            if($ue->save())
            {
                return $ue;
            }
        }
        return false;
    }
    
    /**
     * Displays a single Acervo model with images
     * @param integer $id
     * @return mixed
     */
    private function createOrUpdate($id = NULL, $ingreso_id = NULL, $ingreso_return = FALSE)
    {   
        $model = NULL;
        
        // Load Acervo ID From Model or Update ID
        $acervo = Yii::$app->request->post('Acervo');
        if(!empty($acervo)&&(array_key_exists('id',$acervo))){
            $acervo_id = $acervo['id'];
        }
        elseif (!empty($id)) {
            $acervo_id = $id;
        }
        
        // Load Acervo model or Create new one
        if(!empty($acervo_id))
        {
            $model = $this->findModel($acervo_id);            
        }
        else 
        {
            $model = new Acervo();
        }
        
        // Load Ingreso ID. Request comes from Ingreso form
        if(!empty($ingreso_id)){
            $model->ingreso_id = $ingreso_id;
        }
        
        // Load Form data into model & Save it
        if ($model->load(Yii::$app->request->post())) {    
            if (!$model->save()) {
                // exception error de guardado
            }                
            $acervo_id = $model->id;            
        }        
        
        // Save UbicacionExterna
        if ($this->saveUbicacionExterna($acervo_id,Yii::$app->request->post('UbicacionExterna'))) 
        {  
            Yii::$app->session->setFlash('success',
                [
                    'type' => 'success',
                    'icon' => 'fa fa-users',
                    'message' => 'Ubicación Externa guardada exitosamente',
                    'title' => 'Carga de ubicación externa',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );            
        }        
        // exception error de guardado
        

        // Load images
        $files = UploadedFile::getInstances($model,'files');
        $upload_ok = TRUE;
        $filesUploads = 0;
        foreach ($files as $file) {                
            $filesUploads ++;
            $multimedia = new Multimedia(); 
            $multimedia->objetos_id = $acervo_id;
            $multimedia->tipoMultimedia_id = 1; // Tipo Imagen

            $ext = end((explode(".", $file->name)));
            $filename = $acervo_id."_".Yii::$app->security->generateRandomString().".{$ext}";
            $multimedia->path = $multimedia->getImageFilePath() . $filename;
            if ($file->saveAs($multimedia->path, true)){
                $multimedia->webPath = $multimedia->getUrlImageFolder() . $filename;
                $multimedia->save();
            }
            else{
                $upload_ok = FALSE;
            }
            $upload_ok = $upload_ok && TRUE;
        }       
        if($filesUploads>0){
            if($upload_ok){
                Yii::$app->session->setFlash('success',
                    [
                        'type' => 'success',
                        'icon' => 'fa fa-users',
                        'message' => 'Imágenes cargadas exitosamente',
                        'title' => 'Carga de imágenes',
                        'positonY' => 'top',
                        'positonX' => 'left'
                    ]                    
                );            
            }else{
                Yii::$app->session->setFlash('error',
                    [
                        //'type' => 'error',
                        'icon' => 'fa fa-users',
                        'message' => 'Una o mas imagenes han sigo cargadas con error',
                        'title' => 'Carga de imágenes',
                        'positonY' => 'top',
                        'positonX' => 'left'
                    ]                    
                );            
            }
        }

        // View to Render
        //Obtener fotos
        $dataprovider = new ArrayDataProvider([
            'allModels' => Multimedia::findAll(['objetos_id'=>$model->id]),
            ]);
         
        if(Yii::$app->request->post('saveClose')==1){           
            if($ingreso_return){
                return $this->redirect(['ingreso/update', 'id' => $model->ingreso_id, 'dataProvider'=> $dataprovider]);                
            }
            return $this->redirect(['view', 'id' => $model->id, 'dataProvider'=> $dataprovider]);
        }

        return $this->render('ingreso', [
            'model' => $model,
            'enableReturn' => $ingreso_return,
            'dataProvider'=> $dataprovider
        ]);
    }

    /**
     * Creates a new Acervo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->createOrUpdate();
    }

    /**
     * Updates an existing Acervo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->createOrUpdate($id);
    }

    
    /**
     * Deletes an existing Acervo model.
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
                    'message' => 'Acervo posee elementos dependientes',
                    'title' => 'Error de Borrado',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );
            return $this->redirect(['view','id'=>$id]);
        }
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
    
    public function actionAddingreso($ingreso_id)
    {
        // Return        
        if(Yii::$app->request->post('saveClose')==2){
            return $this->redirect(['ingreso/update', 'id' => $ingreso_id]);                
        }
        
        return $this->createOrUpdate(
            NULL,
            $ingreso_id,
            TRUE
        );        
    }
    public function actionUpdateIngreso($id)
    {
        // Return
        if(Yii::$app->request->post('saveClose')==2){
            $model = $this->findModel($id);
            $dataprovider = new ArrayDataProvider([
                'allModels' => Multimedia::findAll(['objetos_id'=>$model->id]),
            ]);
            return $this->redirect(['ingreso/update', 'id' => $model->ingreso_id, 'dataprovider' => $dataprovider]);                
        }    
        
        return $this->createOrUpdate(
            $id,
            NULL,
            TRUE
        );
    }
    
    
}
