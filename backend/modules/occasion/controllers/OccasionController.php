<?php

namespace backend\modules\occasion\controllers;

use Yii;
use backend\modules\occasion\models\Occasion;
use backend\modules\occasion\models\OccasionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OccasionController implements the CRUD actions for Occasion model.
 */
class OccasionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Occasion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new OccasionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Occasion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Occasion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Occasion();
        $model->scenario = 'backend_create_occasion'; 

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                Yii::$app->session->setFlash('success','Occasion created successfully.'); 
                return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Occasion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id);
        $model->scenario = 'backend_update_occasion'; 


        if ($model->load(Yii::$app->request->post())) 
        {
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                    Yii::$app->session->setFlash('success','Occasion updated successfully.'); 
                    return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Occasion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Occasion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Occasion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Occasion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
