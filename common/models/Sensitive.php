<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sensitive".
 *
 * @property integer $id
 * @property integer $node_id
 * @property string $words
 */
class Sensitive extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sensitive}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['node_id', 'words'], 'required'],
            ['status', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'node_id' => Yii::t('app', 'Node ID'),
            'words' => Yii::t('app', 'Words'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getNodeList()
    {
        return ArrayHelper::map(Node::find()->all(), 'id', 'name');
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => '正常',
            self::STATUS_INACTIVE => '禁用',
        ];
    }
}
