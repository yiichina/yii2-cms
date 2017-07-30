<?php

namespace app\modules\user\controllers;

use Yii;
use common\models\User;
use common\models\Profile;
use common\models\PasswordForm;
use frontend\models\AvatarForm;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\widgets\Image;
use yii\filters\AccessControl;

/**
 * SiteController implements the CRUD actions for User model.
 */
class SiteController extends Controller
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        // user login or signup comes here
        if($attributes['client'] == 'qq')
            $model = User::find()->where(['qq_openid' => $attributes['openid']])->one();
        elseif($attributes['client'] == 'weibo')
            $model = User::find()->where(['weibo_openid' => $attributes['openid']])->one();

        if($model === null)
            $model = new User();

        Yii::$app->user->login($model, 3600 * 24 * 30);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Profile::findOne(Yii::$app->user->id) !== null) {
            $model = Profile::findOne(Yii::$app->user->id);
        } else {
            $model = new Profile;
            $model->user_id = Yii::$app->user->id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', '个人信息修改成功。');
            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionEmail()
    {
        $model = User::findOne(Yii::$app->user->id);

        if($model->load(Yii::$app->request->post())) {
            $model->status = User::STATUS_INACTIVE;
            if($model->save(false)) {
                Yii::$app->getSession()->setFlash('success', '绑定邮箱修改成功。');
                return $this->refresh();
            }
        }
        return $this->render('email', [
            'model' => $model,
        ]);
    }

    public function actionAvatar()
    {
        $model = new AvatarForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $object = UploadedFile::getInstance($model, 'file');
            $object->saveAs($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg');

            Image::crop($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg', $model->w, $model->h, [$model->x, $model->y])
                ->save($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg', ['quality' => 100]);
            
            Image::thumbnail($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg', 200, 200)
                ->save($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg', ['quality' => 100]);

            Image::thumbnail($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg', 120, 120)
                ->save($model->avatarDir . $model->avatarPrefix . '_avatar_middle.jpg', ['quality' => 100]);

            Image::thumbnail($model->avatarDir . $model->avatarPrefix . '_avatar_big.jpg', 48, 48)
                ->save($model->avatarDir . $model->avatarPrefix . '_avatar_small.jpg', ['quality' => 100]);

            return $this->refresh();

        }

        $user = $this->findModel(Yii::$app->user->id);

        return $this->render('avatar', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionPassword()
    {
        $model = new PasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', '密码修改成功。');
            return $this->refresh();
        }

        return $this->render('password',[
            'model' => $model,
        ]);
    }

    public function actionThird()
    {
        return $this->render('third');
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
