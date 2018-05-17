<?php
    return [
        'class' => '\yii\mongodb\Connection',
        'dsn' => 'mongodb://@localhost:27017/MoisesVille',
        'options' => [
            "username" => 'qwavee',
            "password" => 'qwavee!321'
        ]
    ]
    
    /*
    
    db.createUser( { user: "qwavee",
                 pwd: "qwavee!321",
                 roles: [ "readWrite"] })
    
    
    */
   ?>