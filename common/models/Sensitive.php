<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sensitive".
 *
 * @property integer $id
 * @property integer $node_id
 * @property string $words
 */
class Sensitive extends \yii\db\ActiveRecord
{
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
            ['node_id', 'integer'],
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
        ];
    }
}
