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
 * @property integer $parent_id
 * @property integer $type
 * @property string $name
 * @property string $description
 * @property integer $status
 */
class Node extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_ARTICLE = 1;
    const TYPE_PICTURE = 2;
    const TYPE_VIDEO = 3;

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
            [['parent_id', 'name', 'description', 'type', 'status'], 'required'],
            [['parent_id', 'type', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => Yii::t('app', 'Parent ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
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

    public function getTypeName()
    {
        return [
            self::TYPE_ARTICLE => 'article',
            self::TYPE_PICTURE => 'picture',
            self::TYPE_VIDEO => 'video',
        ][$this->type];
    }

    public function getTypeClass()
    {
        return "\common\models\\" . ucfirst($this->typeName);
    }

    public function getTypeList()
    {
        return [
            self::TYPE_ARTICLE => '文章',
            self::TYPE_PICTURE => '图片',
            self::TYPE_VIDEO => '视频',
        ];
    }

    public static function getItems()
    {
        return ArrayHelper::map(Node::find()->all(), 'id', 'name');
    }

    public static function getMenuItems($id = 0)
    {
        $items = [];
        $model = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $id])->all();

        if(count($model)) {
            foreach($model as $item) {
                $items[] = [
                    'icon' => Icon::show('circle-o', 'fa'),
                    'label' => Icon::show('circle-o', 'fa') . Html::tag('span', $item->name),
                    'url' => ['post/index', 'node_id' => $item->id],
                    'items' => self::getMenuItems($item->id),
                    'active' => Yii::$app->controller->id == 'post' && (Yii::$app->request->get('node_id') == $item->id),
                ];
            }
        }

        return $items;
    }
}
