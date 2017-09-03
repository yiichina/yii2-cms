<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DocController implements the CRUD actions for Post model.
 */
class DocController extends Controller
{
    /**
     * Show Docs.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
