<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex($node_id)
    {
        $searchModel = new PostSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['PostSearch']['node_id'] = $node_id;
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'node_id' => $node_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($node_id)
    {
        $post = new Post();
        $post->node_id = $node_id;
        $model = new $post->node->typeClass;

        if ($post->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            Yii::$app->db->transaction(function() use($post, $model) {
                $post->save() && $post->link($post->node->typeName, $model);
            });
            return $this->redirect(['admin']);
        } else {
            return $this->render('create', [
                'post' => $post,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = $this->findModel($id);
        $relationName = $post->node->typeName;
        $model = $post->$relationName;

        if ($post->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            Yii::$app->db->transaction(function() use($post, $model) {
                $post->save() && $post->link($post->node->typeName, $model);
            });
            return $this->redirect(['admin']);
        } else {
            return $this->render('update', [
                'post' => $post,
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
