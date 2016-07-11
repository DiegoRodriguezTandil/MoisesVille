<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "organizacion".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $organizacionTipo_id
 * @property string $telefono
 * @property string $email
 * @property string $info
 * @property string $imagen
 * @property string $sitioWeb
 * @property string $nuestrasColecciones
 * @property string $facebook
 * @property string $twitter
 * @property string $instagram
 * @property string $googleMas
 * @property string $linkedin
 * @property string $mapaLink
 * @property string $pais
 * @property string $ciudad
 * @property string $provincia
 * @property string $direccion
 * @property string $cp
 *
 * @property OrganizacionTipo $organizacionTipo
 * @property User[] $users
 */
class Organizacion extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'organizacionTipo_id'], 'required'],
            [['id', 'organizacionTipo_id'], 'integer'],
            [['info', 'nuestrasColecciones'], 'string'],
            [['nombre'], 'string', 'max' => 150],
            [['telefono'], 'string', 'max' => 45],
            [['email', 'facebook', 'twitter', 'instagram', 'googleMas', 'linkedin'], 'string', 'max' => 100],
            [['imagen', 'sitioWeb', 'mapaLink', 'direccion'], 'string', 'max' => 255],
            [['pais', 'ciudad', 'provincia'], 'string', 'max' => 50],
            [['cp'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'organizacionTipo_id' => Yii::t('app', 'Organizacion Tipo ID'),
            'telefono' => Yii::t('app', 'Telefono'),
            'email' => Yii::t('app', 'Email'),
            'info' => Yii::t('app', 'Info'),
            'imagen' => Yii::t('app', 'Imagen'),
            'sitioWeb' => Yii::t('app', 'Sitio Web'),
            'nuestrasColecciones' => Yii::t('app', 'Nuestras Colecciones'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'instagram' => Yii::t('app', 'Instagram'),
            'googleMas' => Yii::t('app', 'Google Mas'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'mapaLink' => Yii::t('app', 'Mapa Link'),
            'pais' => Yii::t('app', 'Pais'),
            'ciudad' => Yii::t('app', 'Ciudad'),
            'provincia' => Yii::t('app', 'Provincia'),
            'direccion' => Yii::t('app', 'Direccion'),
            'cp' => Yii::t('app', 'Cp'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizacionTipo()
    {
        return $this->hasOne(OrganizacionTipo::className(), ['id' => 'organizacionTipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['organizacion_id' => 'id']);
    }
    
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'imagen');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        //$this->filename = $image->name;
        $this->imagen = $image->name;
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
       // $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";
        $this->imagen = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }
    
    public function getImageFile() 
    {
        return isset($this->imagen) ? Yii::$app->params['uploadPath'] . $this->imagen : null;
    }
    
     public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->imagen) ? $this->imagen : 'default_user.jpg';
        return Yii::$app->params['uploadPath'] . $avatar;
    }

    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->imagen = null;
       // $this->filename = null;

        return true;
    }
}
