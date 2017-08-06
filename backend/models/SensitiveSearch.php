<?php

namespace backend\models;

use common\models\Sensitive;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SensitiveSearch represents the model behind the search form about `common\models\Sensitive`.
 */
class SensitiveSearch extends Sensitive
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['node_id', 'integer'],
            ['words', 'safe'],
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
        $query = Sensitive::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'node_id' => $this->node_id,
        ]);

        // grid filtering conditions
        $query->andFilterWhere(['like', 'words', $this->words]);

        return $dataProvider;
    }
}
