<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "multimedia".
 *
 * @property integer $id
 * @property string $path
 * @property string $webPath
 * @property integer $tipoMultimedia_id
 * @property integer $objetos_id
 *
 * @property Acervo $objetos
 * @property TipoMultimedia $tipoMultimedia
 */
class Multimedia extends \yii\db\ActiveRecord
{
    /**
    * @var mixed image the attribute for rendering the file input
    * widget for upload on the form
    */
    public $image;
    public $file;
    public $files;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'multimedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file','maxFiles' => 6],
            [['tipoMultimedia_id', 'objetos_id'], 'required'],
            [['tipoMultimedia_id', 'objetos_id'], 'integer'],
            [['path', 'webPath'], 'string', 'max' => 255]
        ];
    }
    
    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage() {
               // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'path');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        //$this->filename = $image->name;
        $this->path = $image->name;
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
       // $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";
        $this->path = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'webPath' => Yii::t('app', 'Web Path'),
            'tipoMultimedia_id' => Yii::t('app', 'Tipo Multimedia ID'),
            'objetos_id' => Yii::t('app', 'Objetos ID'),
            'objetoName' => Yii::t('app', 'Acervo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasOne(Acervo::className(), ['id' => 'objetos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMultimedia()
    {
        return $this->hasOne(TipoMultimedia::className(), ['id' => 'tipoMultimedia_id']);
    }
    
    public function getImageFilePath() 
    {
        if( substr(Yii::$app->params['uploadPath'],-1) == DIRECTORY_SEPARATOR ){
            return Yii::$app->params['uploadPath'];
        }
        return Yii::$app->params['uploadPath'] . DIRECTORY_SEPARATOR;
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
        $this->path = null;
       // $this->filename = null;

        return true;
    }
    
    public function getObjetoName(){
        $acervo = $this->objetos;
        if($acervo){           
            return $acervo->nombre;
        }
        return '';
    }
}
