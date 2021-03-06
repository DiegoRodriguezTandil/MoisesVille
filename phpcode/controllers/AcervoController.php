<?php

namespace app\controllers;

use Yii;
use app\models\Acervo;
use app\models\Multimedia;
use app\models\UbicacionExterna;
use yii\data\ArrayDataProvider;
use app\models\AcervoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

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
        // if (isset($model->copia)) {
        // $model->copia='no';
        // }
        // $model->copia='doc';
// var_dump($model->copia);
//         die();
        return $this->render('view', [
            'model' => $model, 
            'dataProvider' => $multimediaProvider,            
        ]);
    }
    
    public function actionPrint($id)
    {   
        $model = $this->findModel($id);
        $multimediaProvider = new ArrayDataProvider([
            'allModels' => Multimedia::findAll(['objetos_id'=>$model->id]),
        ]);
//        $this->render('print', [
//            'model' => $model, 
//            'dataProvider' => $multimediaProvider,            
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
                                'model' => $model, 
                                'dataProvider' => $multimediaProvider,      
                            ]),
            'options' => [
                'title' => 'Acervo'               
            ],
            'methods' => [
                'SetHeader' => ['Gestión de Colecciones'],
                'SetFooter' => ['|Página {PAGENO}|'],
            ]
        ]);
        
        return $pdf->render();
    }
    
    private function saveUbicacionExterna($acervo_id, $ubicacion, $finicio,$fcierre){
$fi=$finicio;
$ff=$fcierre;

        if(
                isset($acervo_id)
                && is_array($ubicacion)
                && array_key_exists('ubicacion', $ubicacion)
                && isset($ubicacion['ubicacion']) && (trim($ubicacion['ubicacion'])!='')
        ){
      
           if(isset($finicio) &&strlen($finicio)>0){
                    list($dia, $mes, $anio) = explode("/",$finicio);
                    $fi= $anio.'-'.$mes.'-'.$dia;
              }
            if(isset($fcierre) and strlen($fcierre)>0 ){
                 list($dia2, $mes2, $anio2) = explode("/",$fcierre);
                 $ff=$anio2.'-'.$mes2.'-'.$dia2;
            }
                     

                 
                    
    // var_dump($finicio);
    //  var_dump($fcierre);die();
                    
            
                $ue = new \app\models\UbicacionExterna();
                $ue->acervo_id = $acervo_id;
                $ue->fechaInicio =$fi;
                $ue->fechaCierre =$ff;
                $ue->ubicacion = $ubicacion['ubicacion'];
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
        $acervo_id = NULL;
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
            $model->publicar_id = 1;            
        }
        // Load Ingreso ID. 
        //Request comes from Ingreso form
        if(!empty($ingreso_id)){
            $model->ingreso_id = $ingreso_id;
            if($model->isNewRecord){
                $model->nroA = $ingreso_id;
            }
        }
        
        // Load Form data into model & Save it
        if ($model->load(Yii::$app->request->post())) {    
            $dia='';
            $dia2='';
            $mes='';
            $mes2='';
            $anio='';
            $anio2='';

            $fechaInicio= Yii::$app->request->post('fechaInicioRestauracion-acervo-fechainiciorestauracion');
            $fechaFin= Yii::$app->request->post('fechaFinRestauracion-acervo-fechafinrestauracion');
            if(  strlen($fechaFin)>0) {
                list($dia2, $mes2, $anio2) = explode("/",$fechaFin);
                $model->fechaFinRestauracion=$anio2.'-'.$mes2.'-'.$dia2;
            }
            if(isset($fechaInicio)and  strlen($fechaInicio)>0 ){
                list($dia, $mes, $anio) = explode("/",$fechaInicio);
                $model->fechaInicioRestauracion=$anio.'-'.$mes.'-'.$dia;//Yii::$app->request->post('fechaFinRestauracion-acervo-fechafinrestauracion');
            }
            if (!$model->save()) {
            // exception err var_dump($model);die();or de guardado
            }
            $acervo_id = $model->id;
        }

        if ($this->saveUbicacionExterna($acervo_id,Yii::$app->request->post('UbicacionExterna'),Yii::$app->request->post('fechaInicio-ubicacionexterna-fechainicio'),Yii::$app->request->post('fechaCierre-ubicacionexterna-fechacierre'))) 
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
            $arrAux = explode(".", $file->name);
            $ext    = array_pop($arrAux);
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
                
        //Obtener Ubicaciones Externas
        $dataprovider_ue = new ArrayDataProvider([
            'allModels' => UbicacionExterna::findAll(['acervo_id'=>$model->id]),
        ]);
         
        if(Yii::$app->request->post('saveClose')==1){           
            if($ingreso_return){
                return $this->redirect(['ingreso/update', 'id' => $model->ingreso_id, 'dataProvider'=> $dataprovider, 'dataProviderUbicacionExterna'=> $dataprovider_ue]);                
            }
            return $this->redirect(['view', 'id' => $model->id, 'dataProvider'=> $dataprovider, 'dataProviderUbicacionExterna'=> $dataprovider_ue]);
        }

        return $this->render('ingreso', [
            'model' => $model,
            'enableReturn' => $ingreso_return,
            'dataProvider'=> $dataprovider,
            'dataProviderUbicacionExterna'=> $dataprovider_ue
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
             //Obtener Ubicaciones Externas
            $dataprovider_ue = new ArrayDataProvider([
            'allModels' => UbicacionExterna::findAll(['acervo_id'=>$model->id])->orderBy('fechaInicio DESC'),
            ]);
            return $this->redirect(['ingreso/update', 'id' => $model->ingreso_id, 'dataprovider' => $dataprovider, 'dataProviderUbicacionExterna'=> $dataprovider_ue]);                
        }    
        
        return $this->createOrUpdate(
            $id,
            NULL,
            TRUE
        );
    }
    
    
}
