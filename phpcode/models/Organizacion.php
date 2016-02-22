<?php

namespace app\models;

use Yii;

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
}
