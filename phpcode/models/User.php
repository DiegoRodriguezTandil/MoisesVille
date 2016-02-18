<?php

namespace app\models;

use Yii;
		
/**
 * * This is the model class for table "user".
*
* @property integer $id
* @property string $username
* @property string $auth_key
* @property string $password
* @property string $email
* @property string $created_at
* @property string $updated_at
* @property string $firstName
* @property string $lastName
*
* @property Ingreso[] $ingresos
*/
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName(){
        return 'user';
    }
    
    public static function findIdentity($id){
	return static::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null){
	throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }
    
    public function getId(){
	return $this->id;
    }
 
    public function getAuthKey(){
	return $this->auth_key;//Here I return a value of my authKey column
    }
 
    public function validateAuthKey($authKey){
	return $this->auth_key === $auth_key;
    }
    
    public static function findByUsername($username){
	return self::findOne(['username'=>$username]);
    }
 
    public function validatePassword($password){
	return $this->password === $password;
    }
    
    public function attributeLabels(){
        return [
            'id' => 'ID',
	    'username' => 'Usuario',
	    'auth_key' => 'Auth Key',
	    'password' => 'Password',
	    'email' => 'Email',
	    'created_at' => 'Created At',
	    'updated_at' => 'Updated At',
	    'firstName' => 'Nombre',
	    'lastName' => 'Apellido',
		       ];
    }
    
}