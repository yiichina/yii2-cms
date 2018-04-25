<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Template extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'name', 'description', 'content'], 'required'],
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
            'user_id' => Yii::t('app', 'Creator'),
            'key' => Yii::t('app', 'Key'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            if($insert) {
                $this->user_id = Yii::$app->user->id;
                $this->created_at = $this->updated_at = time();
            } else {
                $this->updated_at = time();
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $filename = Yii::getAlias('@frontend/views/' . $this->key) . '.php';
        if(!is_dir(dirname($filename))) {
            mkdir(dirname($filename));
        }
        file_put_contents($filename, $this->content);
    }

    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => '正常',
            self::STATUS_INACTIVE => '禁用',
        ];
    }
}
