<?php
namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $source
 * @property string $source_id
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'source', 'source_id'], 'required'],
            [['user_id'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => 255]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getAuthorizedClients()
    {
        $userId = Yii::$app->user->id;
        $clients = Auth::find()->where(['user_id' => $userId])->select(['source', 'source_id'])->asArray()->all();
        return ArrayHelper::map($clients, 'source', 'source_id');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function unlinkClient($client)
    {
        $userId = Yii::$app->user->id;
        $client = Auth::find()->where(['user_id' => $userId, 'source' => $client])->one();
        return ($client) ? $client->delete() : false;
    }
}