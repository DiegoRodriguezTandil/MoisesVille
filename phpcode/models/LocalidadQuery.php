<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Localidad]].
 *
 * @see Localidad
 */
class LocalidadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Localidad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Localidad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function topTen(){
        $this->limit(10);
        
        return $this;
    }
}