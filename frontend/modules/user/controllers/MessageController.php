<?php

namespace app\modules\user\controllers;

use Yii;
use common\models\Message;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Message::find()->where(['to_id' => Yii::$app->user->id])->orWhere(['from_id' => Yii::$app->user->id])->andWhere(['parent_id' => 0])->orderBy('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if($model->from_id != Yii::$app->user->id && $model->to_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $message = new Message;
        $to_id = Yii::$app->user->id == $model->from_id ? $model->to_id : $model->from_id;
        $to = User::findOne($to_id);
        $message->to_id = $to->username;
        $message->parent_id = $id;

        $dataProvider = new ActiveDataProvider([
            'query' => Message::find()->where(['id' => $id])->orWhere(['parent_id' => $id]),
        ]);

        if ($message->load(Yii::$app->request->post()) && $message->save()) {
            return $this->refresh();
        }

        return $this->render('view', [
            'message' => $message,
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new Message();

        if(!empty($id)) {
            $user = User::find()->where(['id' => $id])->one();
            $model->to_id = $user->username;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
