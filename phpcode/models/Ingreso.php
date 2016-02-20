<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingreso".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $fechaEntrada
 * @property resource $observaciones
 * @property string $fechaBaja
 * @property integer $user_id
 *
 * @property Acervo[] $acervos
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
            [['user_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 45]
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
}
