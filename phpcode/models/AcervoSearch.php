<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acervo;

/**
 * AcervoSearch represents the model behind the search form about `app\models\Acervo`.
 */
class AcervoSearch extends Acervo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipoAcervo_id', 'unidadMedida_id', 'unidadPeso_id', 'ingreso_id', 'estado_id', 'ubicacion_id', 'motivoBaja_id', 'copia_id', 'codformaing', 'codtipoac', 'clasifac', 'publicar_id', 'idold'], 'integer'],
            [['nombre', 'descripcion', 'nroInventario', 'forma', 'material', 'fechaIngreso', 'caracteristicas', 'lugarprocac', 'color', 'notas', 'fechaBaja', 'descEpoca', 'descUbicacion', 'nroA', 'nroB', 'nroC', 'nroD'], 'safe'],
            [['ancho', 'largo', 'alto', 'peso', 'diametroInterno', 'diametroExterno'], 'number'],
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
        $query = Acervo::find();

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
            'tipoAcervo_id' => $this->tipoAcervo_id,
            'ancho' => $this->ancho,
            'largo' => $this->largo,
            'alto' => $this->alto,
            'unidadMedida_id' => $this->unidadMedida_id,
            'peso' => $this->peso,
            'unidadPeso_id' => $this->unidadPeso_id,
            'diametroInterno' => $this->diametroInterno,
            'diametroExterno' => $this->diametroExterno,
            'fechaIngreso' => $this->fechaIngreso,
            'ingreso_id' => $this->ingreso_id,
            'estado_id' => $this->estado_id,
            'ubicacion_id' => $this->ubicacion_id,
            'fechaBaja' => $this->fechaBaja,
            'motivoBaja_id' => $this->motivoBaja_id,
            'copia_id' => $this->copia_id,
            'codformaing' => $this->codformaing,
            'codtipoac' => $this->codtipoac,
            'clasifac' => $this->clasifac,
            'publicar_id' => $this->publicar_id,
            'idold' => $this->idold,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'nroInventario', $this->nroInventario])
            ->andFilterWhere(['like', 'forma', $this->forma])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'caracteristicas', $this->caracteristicas])
            ->andFilterWhere(['like', 'lugarprocac', $this->lugarprocac])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'notas', $this->notas])
            ->andFilterWhere(['like', 'descEpoca', $this->descEpoca])
            ->andFilterWhere(['like', 'descUbicacion', $this->descUbicacion])
            ->andFilterWhere(['like', 'nroA', $this->nroA])
            ->andFilterWhere(['like', 'nroB', $this->nroB])
            ->andFilterWhere(['like', 'nroC', $this->nroC])
            ->andFilterWhere(['like', 'nroD', $this->nroD]);

        return $dataProvider;
    }
}
