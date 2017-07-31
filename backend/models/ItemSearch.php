<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\data\ArrayDataProvider;

/**
 * NodeSearch represents the model behind the search form about `common\models\Node`.
 */
class ItemSearch extends Item
{
    public $name;
    public $description;
    public $rule_name;
    protected $type = 1;
    protected $manager;

    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    public function init()
    {
        $this->manager = \Yii::$app->authManager;
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $dataProvider = \Yii::createObject(ArrayDataProvider::className());

        $query = (new Query)->select(['name', 'description', 'rule_name'])
            ->andWhere(['type' => $this->type])
            ->from($this->manager->itemTable);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'rule_name', $this->rule_name]);
        }

        $dataProvider->allModels = $query->all($this->manager->db);

        return $dataProvider;
    }
}
