<?php

namespace app\modules\user\controllers;

use Yii;
use common\models\Notice;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * NoticeController implements the CRUD actions for Notice model.
 */
class NoticeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Lists all Notice models.
     * @return mixed
     */
    public function actionIndex($type = null)
    {
        $query = Notice::find()->where(['user_id' => Yii::$app->user->id])->orderBy('created_at DESC');

        if(isset($type)) {
            if($type == 'mention') {
                $query->andWhere(['like', 'type', '@']);
                Notice::updateAll(['is_read' => 1], ['and', ['like', 'type', '@'], ['user_id' => Yii::$app->user->id]]);
            } else {
                $query->andWhere(['type' => $type]);
                Notice::updateAll(['is_read' => 1], ['type' => $type, 'user_id' => Yii::$app->user->id]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
