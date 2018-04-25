<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yiichina\icons\Icon;
use common\models\Node;

/**
 * This is the model class for table "node".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $type
 * @property string $name
 * @property string $description
 * @property integer $status
 */
class Pubport extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_INDEX = 1;
    const TYPE_LIST = 2;
    const TYPE_DOCUMENT = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pubport}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'description', 'type', 'status'], 'required'],
            [['node_id', 'type', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => Yii::t('app', 'Type'),
            'key' => Yii::t('app', 'key'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getParentList()
    {
        return array_merge(['0' => 'ROOT'], ArrayHelper::map(Node::find()->all(), 'id', 'name'));
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => '正常',
            self::STATUS_INACTIVE => '禁用',
        ];
    }

    public function getStatusLabel()
    {
        return [
            self::STATUS_INACTIVE => Html::tag('small', Icon::show('delete') . Yii::t('app', 'Deleted'), ['class' => 'label label-danger']),
            self::STATUS_ACTIVE => Html::tag('small', Icon::show('check') . Yii::t('app', 'Active'), ['class' => 'label label-success']),
        ][$this->status];
    }

    public function getTypeClass()
    {
        return "\common\models\\" . ucfirst($this->typeName);
    }

    public function getTypeList()
    {
        return [
            self::TYPE_INDEX => '首页',
            self::TYPE_LIST => '列表页',
            self::TYPE_DOCUMENT => '文档',
        ];
    }

    public static function getItems()
    {
        return ArrayHelper::map(Node::find()->all(), 'id', 'name');
    }

    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }

    public function getNode()
    {
        return $this->hasOne(Node::className(), ['id' => 'node_id']);
    }

    public function getNodeList()
    {
        return ArrayHelper::map(Node::find()->all(), 'id', 'name');
    }

    public static function getMenuItems($id = 0)
    {
        $items = [];
        $model = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $id])->all();
        foreach($model as $item) {
            $active = Yii::$app->request->get('node_id') == $item->id;
            $subMenuItems = self::getMenuItems($item->id);
            if($active === false) {
                foreach ($subMenuItems as $subItem) {
                    if (isset($subItem['active']) && $subItem['active']) {
                        $active = true;
                    }
                }
            }
            $items[] = [
                'icon' => Icon::show($item->typeIcon),
                'label' => Html::tag('span', $item->name),
                'url' => ['post/index', 'node_id' => $item->id],
                'items' => $subMenuItems,
                'active' => $active,
            ];
        }

        return $items;
    }
}
