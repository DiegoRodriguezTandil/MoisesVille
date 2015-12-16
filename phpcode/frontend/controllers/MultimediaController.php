<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Multimedia;
use frontend\models\MultimediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MultimediaController implements the CRUD actions for Multimedia model.
 */
class MultimediaController extends Controller
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
     * Lists all Multimedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MultimediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'tipoMultimedia_id' => $model->tipoMultimedia_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
    public function actionDelete($id, $tipoMultimedia_id)
    {
        $this->findModel($id, $tipoMultimedia_id)->delete();

        return $this->redirect(['index']);
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
