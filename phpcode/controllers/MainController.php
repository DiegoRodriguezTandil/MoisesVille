<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * IngresoController implements the CRUD actions for Ingreso model.
 */
class MainController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],            
        ];
    }


}
