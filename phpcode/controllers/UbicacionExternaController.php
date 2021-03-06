<?php

namespace app\controllers;

use Yii;
use app\models\UbicacionExterna;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UbicacionExternaController implements the CRUD actions for UbicacionExterna model.
 */
class UbicacionExternaController extends Controller
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
     * Lists all UbicacionExterna models.
     * @return mixed
     */
    public function actionIndex()
    {
//        var_dump(Yii::$app->request->post('UbicacionExterna'));
//            die();
        $model = new UbicacionExterna();
        $m = $model->load(Yii::$app->request->post('UbicacionExterna'));
        $s = $model->save();
        if ($m) die('cargo el model');
        if ($s) {
            var_dump(Yii::$app->request->post('UbicacionExterna'));
            die();
            return $this->redirect(['index', 'id' => $model->id]);
        } 
//        else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//        if 
//            $model->load(Yii::$app->request->post()
        $dataProvider = new ActiveDataProvider([
            'query' => UbicacionExterna::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UbicacionExterna model.
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
     * Creates a new UbicacionExterna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UbicacionExterna();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UbicacionExterna model.
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
     * Deletes an existing UbicacionExterna model.
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
     * Finds the UbicacionExterna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UbicacionExterna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UbicacionExterna::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
