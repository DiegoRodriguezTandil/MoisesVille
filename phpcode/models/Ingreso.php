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
 * @property integer $tipoPersona_id
 * @property integer $formaIngreso_id
 * @property integer $persona_id_depositante
 *
 * @property Acervo[] $acervos
 * @property FormaIngreso $formaIngreso
 * @property Persona $persona
 * @property Persona $personaIdDepositante
 * @property TipoPersona $tipoPersona
 * @property User $user
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
            [['user_id', 'persona_id', 'tipoPersona_id', 'formaIngreso_id', 'persona_id_depositante'], 'integer'],
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
            'tipoPersona_id' => Yii::t('app', 'Tipo Persona'),
            'formaIngreso_id' => Yii::t('app', 'Forma Ingreso ID'),
            'persona_id_depositante' => Yii::t('app', 'Persona Depositante'),
            'userName' => Yii::t('app', 'Usuario'),
            'personaName' => Yii::t('app', 'Persona Donante'),
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
    public function getFormaIngreso()
    {
        return $this->hasOne(FormaIngreso::className(), ['id' => 'formaIngreso_id']);
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
    public function getPersonaIdDepositante()
    {
        return $this->hasOne(Persona::className(), ['id' => 'persona_id_depositante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPersona()
    {
        return $this->hasOne(TipoPersona::className(), ['id' => 'tipoPersona_id']);
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
