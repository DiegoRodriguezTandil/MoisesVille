<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Objetos;

/**
 * ObjetosSearch represents the model behind the search form about `frontend\models\Objetos`.
 */
class ObjetosSearch extends Objetos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'colecciones_id', 'tema_id', 'tipoAcervo_id', 'ancho', 'largo', 'alto', 'peso', 'diametroInterno', 'diametroExterno'], 'integer'],
            [['nombre', 'descripcion', 'nroInventario', 'forma', 'material', 'fechaIngreso'], 'safe'],
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
        $query = Objetos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'colecciones_id' => $this->colecciones_id,
            'tema_id' => $this->tema_id,
            'tipoAcervo_id' => $this->tipoAcervo_id,
            'ancho' => $this->ancho,
            'largo' => $this->largo,
            'alto' => $this->alto,
            'peso' => $this->peso,
            'diametroInterno' => $this->diametroInterno,
            'diametroExterno' => $this->diametroExterno,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'nroInventario', $this->nroInventario])
            ->andFilterWhere(['like', 'forma', $this->forma])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'fechaIngreso', $this->fechaIngreso]);

        return $dataProvider;
    }
}
