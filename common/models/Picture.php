<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $url
 * @property string $description
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'url'], 'required'],
            ['post_id', 'integer'],
            ['description', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => Yii::t('app', 'Post ID'),
            'url' => 'URL',
            'description' => Yii::t('app', 'Description'),
        ];
    }

}
