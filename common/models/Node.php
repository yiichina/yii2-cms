<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yiichina\icons\Icon;

/**
 * This is the model class for table "node".
 *
 * @property integer $id
 * @property string $parent_id
 * @property integer $name
 * @property integer $description
 * @property integer $status
 */
class Node extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%node}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'description', 'status'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '父栏目',
            'name' => '栏目名称',
            'description' => '栏目描述',
            'status' => '状态',
        ];
    }

    public function getParentList()
    {
        return ArrayHelper::merge(['0' =>'root'], ArrayHelper::map($this->find()->all(), 'id', 'name'));
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => '正常',
            self::STATUS_INACTIVE => '禁用',
        ];
    }

    public static function getMenuItems($id = 0)
    {
        $items = [];

        $model = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $id])->all();
        if(count($model)) {
            foreach($model as $item) {
                $items[] = [
                    'label' => Icon::show('circle-o', 'fa') . Html::tag('span', $item->name),
                    'url' => ['post/index', 'node_id' => $item->id],
                    'items' => self::getMenuItems($item->id),
                    'active' => Yii::$app->controller->id == 'post' && Yii::$app->request->get('node_id') == $item->id,
                ];
            }
        }

        return $items;
    }
}
