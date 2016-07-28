<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ingreso;

/**
 * IngresoSearch represents the model behind the search form about `app\models\Ingreso`.
 */
class IngresoSearch extends Ingreso
{
    
    public $personaName;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['descripcion', 'fechaEntrada', 'observaciones', 'fechaBaja', 'personaName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ingreso::find();//->where();//(['autoSave'=>'N']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
            'attributes'=>[
                'descripcion',
                'fechaEntrada',
                'fechaBaja',
                'observaciones',
                'personaName' => [
                    'asc' => ['concat(coalesce(persona.apellido,""),coalesce(persona.nombre,""))' => SORT_ASC],
                    'desc' => ['concat(coalesce(persona.apellido,""),coalesce(persona.nombre,""))' => SORT_DESC],
                    'label' => 'Persona'
                ]                
            ]
        ]);
        
        $this->load($params);
        if ( ! $this->validate() ) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['persona']);
            return $dataProvider;
        }        

        $query->andFilterWhere([
            'id' => $this->id,
            'fechaEntrada' => $this->fechaEntrada,
            'fechaBaja' => $this->fechaBaja,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);
        
        if(trim($this->personaName)!=''){
            $query->joinWith(['persona' => function ($q) {
                $q->where('concat(coalesce(persona.apellido,""),coalesce(persona.nombre,"")) LIKE "%' . $this->personaName . '%"');
            }]);            
        }
        else{
            $query->joinWith('persona');
        }

        return $dataProvider;
    }
}
