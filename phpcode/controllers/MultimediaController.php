<?php

namespace app\controllers;

use Yii;
use app\models\Multimedia;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MultimediaController implements the CRUD actions for Multimedia model.
 */
class MultimediaController extends MainController
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


    /**
     * Lists all Multimedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Multimedia::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Multimedia model.
     * @param integer $id
     * @param integer $tipoMultimedia_id
     * @return mixed
     */
    public function actionView($id, $tipoMultimedia_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $tipoMultimedia_id),
        ]);
    }

    /**
     * Creates a new Multimedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Multimedia();
        
        if ($model->load(Yii::$app->request->post())){
            // process uploaded image file instance
            $image = $model->uploadImage();
            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id' => $model->id, 'tipoMultimedia_id' => $model->tipoMultimedia_id]);
            }
            
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }


        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'tipoMultimedia_id' => $model->tipoMultimedia_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
        
    }
    

    /**
     * Updates an existing Multimedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $tipoMultimedia_id
     * @return mixed
     */
    public function actionUpdate($id, $tipoMultimedia_id)
    {
        $model = $this->findModel($id, $tipoMultimedia_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'tipoMultimedia_id' => $model->tipoMultimedia_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Multimedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $tipoMultimedia_id
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
                    'message' => 'El elemento multimedia posee elementos dependientes',
                    'title' => 'Error de Borrado',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );
            return $this->redirect(['view','id'=>$id]);
        }
    }

    /**
     * Finds the Multimedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $tipoMultimedia_id
     * @return Multimedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $tipoMultimedia_id)
    {
        if (($model = Multimedia::findOne(['id' => $id, 'tipoMultimedia_id' => $tipoMultimedia_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
