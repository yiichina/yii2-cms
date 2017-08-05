<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    public $tags;

    const STATUS_TRASH = -1;
    const STATUS_DRAFT = 0;
    const STATUS_PENDING = 1;
	const STATUS_PUBLISHED = 2;
    const STATUS_FEATURED = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'node_id'], 'required'],
            [['title'], 'string', 'max' => 50],
            //[['title'], 'checkWords'],
            ['title', 'unique', 'targetClass' => '\common\models\Post', 'message' => '此标题已被使用，请输入其它标题。'],
            //['status', 'integer'],
            ['tags', 'safe'],
        ];
    }

    public function getArticle()
    {
        return $this->hasMany(Article::className(), ['post_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '作者',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'created_at' => '发布时间',
            'updated_at' => '修改时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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

    public function getNode()
    {
        return $this->hasOne(Node::className(), ['id' => 'node_id']);
    }
}
