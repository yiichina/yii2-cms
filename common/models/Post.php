<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $pubport_id
 * @property string $title
 * @property string $summary
 * @property string $source
 * @property string $image
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_TRASH = -1;
    const STATUS_DRAFT = 0;
    const STATUS_PENDING = 1;
	const STATUS_PUBLISHED = 2;
    const STATUS_FEATURED = 3;

    public $tags;

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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'pubport_id'], 'required'],
            [['title', 'source'], 'string', 'max' => 255],
            ['title', 'checkWords'],
            ['summary', 'string', 'max' => 1024],
            ['title', 'unique', 'targetClass' => '\common\models\Post'],
            [['type', 'pubport_id', 'status'], 'integer'],
            [['summary', 'source', 'image', 'tags'], 'safe'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'pubport_id' => Yii::t('app', 'Pubport ID'),
            'title' => Yii::t('app', 'Title'),
            'summary' => Yii::t('app', 'Summary'),
            'source' => Yii::t('app', 'Source'),
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'tags' => Yii::t('app', 'Tags'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function checkWords()
    {}

    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['post_id' => 'id']);
    }

    public function getPicture()
    {
        return $this->hasMany(Picture::className(), ['post_id' => 'id']);
    }

    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['post_id' => 'id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPubport()
    {
        return $this->hasOne(Pubport::className(), ['id' => 'pubport_id']);
    }

    public function getUrl()
    {
        return Url::to(['/post/view', 'id'=>$this->id]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            if($insert) {
                $this->user_id = Yii::$app->user->id;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => '草稿',
            self::STATUS_PENDING => '待发布',
            self::STATUS_PUBLISHED => '已发布',
            self::STATUS_FEATURED => '精华',
        ];
    }
}
