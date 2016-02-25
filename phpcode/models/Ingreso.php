<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingreso".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $fechaEntrada
 * @property string $observaciones
 * @property string $fechaBaja
 * @property integer $user_id
 * @property string $autoSave
 * @property integer $persona_id
 * @property integer $formaIngreso_id
 *
 * @property Acervo[] $acervos
 * @property User $user
 * @property Persona $persona
 * @property FormaIngreso $formaIngreso
 */
class Ingreso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingreso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaEntrada', 'fechaBaja'], 'safe'],
            [['observaciones'], 'string'],
            [['user_id'], 'required'],
            [['user_id', 'persona_id', 'formaIngreso_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 45],
            [['autoSave'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'fechaEntrada' => Yii::t('app', 'Fecha Entrada'),
            'observaciones' => Yii::t('app', 'Observaciones'),
            'fechaBaja' => Yii::t('app', 'Fecha Baja'),
            'user_id' => Yii::t('app', 'User ID'),
            'autoSave' => Yii::t('app', 'Auto Save'),
            'persona_id' => Yii::t('app', 'Persona'),
            'formaIngreso_id' => Yii::t('app', 'Forma Ingreso ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcervos()
    {
        return $this->hasMany(Acervo::className(), ['ingreso_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['id' => 'persona_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormaIngreso()
    {
        return $this->hasOne(FormaIngreso::className(), ['id' => 'formaIngreso_id']);
    }
    
    public function getUserName(){
        $user = $this->user;
        if($user){
            return $user->lastName.' '. $user->firstName.' ('.$user->username.')';
        }
        return '';
    }
    
    public function getPersonaName(){
        $persona = $this->persona;
        if($persona){
            return $persona->apellido.' '. $persona->nombre;
        }
        return '';
    }
}
