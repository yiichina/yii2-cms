<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $flv
 * @property integer $length
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flv'], 'required'],
            ['length', 'integer'],
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
            'flv' => Yii::t('app', 'Flv'),
            'length' => Yii::t('app', 'Length'),
        ];
    }

}
