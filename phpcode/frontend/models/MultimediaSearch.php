<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Multimedia;

/**
 * MultimediaSearch represents the model behind the search form about `frontend\models\Multimedia`.
 */
class MultimediaSearch extends Multimedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipoMultimedia_id', 'objetos_id'], 'integer'],
            [['path', 'webPath'], 'safe'],
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
        $query = Multimedia::find();

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
            'tipoMultimedia_id' => $this->tipoMultimedia_id,
            'objetos_id' => $this->objetos_id,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'webPath', $this->webPath]);

        return $dataProvider;
    }
}
