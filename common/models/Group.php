<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $node_id
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'node_ids'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Name'),
            'node_ids' => Yii::t('app', 'Node IDs'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            $this->node_ids = implode(',', $this->node_ids);
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->node_ids = explode(',', $this->node_ids);
    }

    public function getNodeLabels()
    {
        $nodes = ArrayHelper::map(Node::findAll($this->node_ids), 'id', 'name');
        $labels = [];
        foreach($nodes as $key => $value) {
            $labels[] = Html::tag('small', $value, ['class' => 'label label-info']);
        }
        return implode(' ', $labels);
    }
}
