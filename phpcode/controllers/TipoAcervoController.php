<?php

namespace app\controllers;

use Yii;
use app\models\TipoAcervo;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipoAcervoController implements the CRUD actions for TipoAcervo model.
 */
class TipoAcervoController extends MainController
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
     * Lists all TipoAcervo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TipoAcervo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoAcervo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TipoAcervo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoAcervo(); 
        $request = Yii::$app->request;
        $tipoac = $request->post('TipoAcervo');
        $tipoac_id = $tipoac['tipoAcervo_id'];        
        if ($tipoac_id == "")
            $model["tipoAcervo_id"] = 0;            
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 
            ]);
        }
    }

    /**
     * Updates an existing TipoAcervo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoAcervo model.
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
                    'message' => 'Tipo acervo posee elementos relacionados',
                    'title' => 'Error de Borrado',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );
            return $this->redirect(['view','id'=>$id]);
        }
    }

    /**
     * Finds the TipoAcervo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoAcervo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoAcervo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
