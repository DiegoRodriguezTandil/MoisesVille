<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organizacion;

/**
 * OrganizacionSearch represents the model behind the search form about `app\models\Organizacion`.
 */
class OrganizacionSearch extends Organizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'organizacionTipo_id'], 'integer'],
            [['nombre', 'telefono', 'email', 'info', 'imagen', 'sitioWeb', 'nuestrasColecciones', 'facebook', 'twitter', 'instagram', 'googleMas', 'linkedin', 'mapaLink', 'pais', 'ciudad', 'provincia', 'direccion', 'cp'], 'safe'],
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
        $query = Organizacion::find();

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
            'organizacionTipo_id' => $this->organizacionTipo_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'imagen', $this->imagen])
            ->andFilterWhere(['like', 'sitioWeb', $this->sitioWeb])
            ->andFilterWhere(['like', 'nuestrasColecciones', $this->nuestrasColecciones])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'googleMas', $this->googleMas])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'mapaLink', $this->mapaLink])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'cp', $this->cp]);

        return $dataProvider;
    }
}
