<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * UserController implements the CRUD actions for User model.
 */



class UserController extends MainController 
{
    // private $idAdmin=1;
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       // var_dump(Yii::$app->request->queryParams);die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if($id!=Yii::$app->params['idAdmin']){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
         }
         return $this->actionIndex();
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

  public function actionCreate()
    {
        $model = new User();
<<<<<<< HEAD
var_dump(Yii::$app->request->post()); die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
=======
            $data[]=Yii::$app->request->post('User');
            $model->username = isset($data[0]['username']) ? $data[0]['username'] : null;
            $model->firstName = isset($data[0]['firstName']) ? $data[0]['firstName'] : null;
            $model->lastName = isset($data[0]['lastName']) ? $data[0]['lastName'] : null;
            $model->password = isset($data[0]['password']) ? $data[0]['password'] : null;
            $model->email = isset($data[0]['email']) ? $data[0]['email'] : null;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
>>>>>>> 12116c092cc70ca1257ca8fe491ca5f63607a322
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        if($id==Yii::$app->params['idAdmin'])
            {
                         Yii::$app->session->setFlash('error',
                        [
                            //'type' => 'error',
                            'icon' => 'fa fa-users',
                            'message' => ' no esta permitido.', 
                            'title' => 'Error de Actualización',
                            'positonY' => 'top',
                            'positonX' => 'left'
                        ]                    
                );
                  return $this->redirect(['view','id'=>$id]);
            }else{

                    $model = $this->findModel($id);

                    if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        try {
            if($id!=Yii::$app->params['idAdmin']){
                if($this->findModel($id)->delete()){
                    return $this->redirect(['index']);
                }
            }else{
                 Yii::$app->session->setFlash('error',
                [
                    //'type' => 'error',
                    'icon' => 'fa fa-users',
                    'message' => ' no esta permitido.', 
                    'title' => 'Error de Borrado',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );
                  return $this->redirect(['view','id'=>$id]);
            }

        } catch (\yii\db\IntegrityException $exc) {
            Yii::$app->session->setFlash('error',
                [
                    //'type' => 'error',
                    'icon' => 'fa fa-users',
                    'message' => 'Usuario posee elementos relacionados, o no esta permitido.', 
                    'title' => 'Error de Borrado',
                    'positonY' => 'top',
                    'positonX' => 'left'
                ]                    
            );
            return $this->redirect(['view','id'=>$id]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPrint() {
        
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->render('usuarios', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

            'content' => $this->renderPartial('usuarios', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]),
            'options' => [
                'title' => 'Listado de Usuarios',
                'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generado el: ' . date("d-M-y")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
    return $pdf->render();
}

}
