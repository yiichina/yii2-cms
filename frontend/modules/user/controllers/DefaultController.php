<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use common\models\Feed;
use common\models\Visit;
use common\models\Follow;
use common\models\Activity;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\Helper;
use frontend\widgets\FollowWidget;
use frontend\widgets\UserPanel;

class DefaultController extends Controller
{
	public $layout = 'default';

    public function actionIndex($id = null, $type = null)
    {
        $id = isset($id) ? $id : Yii::$app->user->id;
        $is_self = Yii::$app->user->id == $id;

    	$user = $this->findModel($id);

        if(Yii::$app->request->isAjax && Yii::$app->request->validateCsrfToken()) {
            echo UserPanel::widget(['id' => $id]);
        } else {
            $query = Activity::find()->where(['user_id' => $id])->orderBy('created_at DESC');
            $model= new Feed();
            
            if($is_self) {
                $fans = $user->getFans()->indexBy('user_id')->all();
                $query->orWhere(['in', 'user_id', array_keys($fans)]);
                if($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->refresh();
                }
            } else {
                if(!Yii::$app->user->isGuest) {
                    $visit = Visit::findOne(['user_id'=>$id, 'caller_id'=>Yii::$app->user->id]);
                    if($visit === null) {
                        $visit = new Visit;
                        $visit->user_id = $id;
                        $visit->save();
                    } else {
                        $visit->update();
                    }
                }
            }

            if(isset($type)) {
                $query->andWhere(['type' => $type]);
            }
            
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            return $this->render('index', [
                'user' => $user,
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionFollow($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => Follow::find()->where(['fans_id' => $id])->orderBy('created_at DESC'),
        ]);

        return $this->render('follow', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionFans($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => Follow::find()->where(['user_id' => $id])->orderBy('created_at DESC'),
        ]);

        return $this->render('fans', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionVisit($id)
    {
        $model = $this->findModel($id);
        
        $dataProvider = new ActiveDataProvider([
            'query' => Visit::find()->where(['user_id' => $id])->orderBy('created_at DESC'),
        ]);

        return $this->render('visit', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Topic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
