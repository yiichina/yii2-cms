<?php

namespace app\modules\user\controllers;

use Yii;
use common\models\Registration;
use common\models\Card;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * RegistrationController implements the CRUD actions for Registration model.
 */
class RegistrationController extends Controller
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
     * Lists all Score models.
     * @return mixed
     */
    public function actionIndex()
    {
        $count = Registration::find()->where(['user_id' => Yii::$app->user->id])->count();
        $current_continuous = Registration::find()->where(['user_id' => Yii::$app->user->id])->orderBy('created_date DESC')->one();
        $most_continuous = Registration::find()->select('*, MAX(continuous) as continuous')->where(['user_id' => Yii::$app->user->id])->one();
        $query = Card::find()->where(['user_id' => Yii::$app->user->id])->orderBy('id DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $card_total = $query->count();
        $card_used = Card::find()->where(['user_id' => Yii::$app->user->id, 'is_used' => 1])->count();

        return $this->render('index', [
            'count' => $count,
            'current_continuous' => $current_continuous->continuous,
            'most_continuous' => $most_continuous->continuous,
            'query' => $query,
            'dataProvider' => $dataProvider,
            'card_total' => $card_total,
            'card_used' => $card_used,
        ]);
    }

    public function actionCreate($date)
    {
        $card = Card::find()->where(['user_id' => Yii::$app->user->id, 'is_used' => 0])->orderBy('created_at asc')->one();
        
        $model = Registration::find()->where(['user_id' => Yii::$app->user->id, 'created_date' => $date])->one();

        $yestoday = Registration::find()->where(['user_id' => Yii::$app->user->id, 'created_date' => date('Y-m-d', strtotime($date . ' -1 day'))])->one();

        if(strtotime($date) > strtotime('-4 days') && strtotime($date) < strtotime('-1 day')) { //只可补三天以内的断签
            if($model === null && $card !== null && $yestoday !== null) { //有补签卡，当天断签，前一天签过到
                $card->is_used = 1;
                if($card->save()) {
                    $model = new Registration;
                    $model->continuous = $yestoday->continuous + 1;
                    $model->created_date = $date;
                    $model->save();

                    $tomorrow = Registration::find()->where(['user_id' => Yii::$app->user->id, 'created_date' => date('Y-m-d', strtotime($date . ' +1 day'))])->one();
                    if($tomorrow !== null) {
                        $tomorrow->continuous = $model->continuous + 1;
                        $tomorrow->save();
                    } else {
                        $this->redirect(['index']);
                    }

                    $thirdday = Registration::find()->where(['user_id' => Yii::$app->user->id, 'created_date' => date('Y-m-d', strtotime($date . ' +2 day'))])->one();
                    if($thirdday !== null) {
                        $thirdday->continuous = $tomorrow->continuous + 1;
                        $thirdday->save();
                    } else {
                        $this->redirect(['index']);
                    }

                    $forthday = Registration::find()->where(['user_id' => Yii::$app->user->id, 'created_date' => date('Y-m-d', strtotime($date . ' +3 day'))])->one();
                    if($forthday !== null) {
                        $forthday->continuous = $thirdday->continuous + 1;
                        $forthday->save();
                    } else {
                        $this->redirect(['index']);
                    }
                }
            }
        }
        $this->redirect(['index']);
    }
}
