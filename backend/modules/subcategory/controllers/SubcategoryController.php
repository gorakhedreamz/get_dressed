<?php

namespace backend\modules\subcategory\controllers;

use Yii;
use backend\modules\subcategory\models\Subcategory;
use backend\modules\subcategory\models\SubcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Yii\helpers\ArrayHelper;
use backend\modules\category\models\Category;

/**
 * SubcategoryController implements the CRUD actions for Subcategory model.
 */
class SubcategoryController extends Controller
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
     * Lists all Subcategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new SubcategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subcategory model.
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
     * Creates a new Subcategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Subcategory();
        $model->scenario = 'backend_create_subcategory'; 

        $category_list = Category::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $category_list = ArrayHelper::map($category_list,'id','category_name');

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                Yii::$app->session->setFlash('success','Subcategory created successfully.'); 
                return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                    'category_list'=>$category_list,
                ]);
            }
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
                'category_list'=>$category_list,
            ]);
        }
    }

    /**
     * Updates an existing Subcategory model.
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
        $model->scenario = 'backend_update_subcategory'; 

        $category_list = Category::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $category_list = ArrayHelper::map($category_list,'id','category_name');


        if ($model->load(Yii::$app->request->post())) 
        {
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                    Yii::$app->session->setFlash('success','Subcategory updated successfully.'); 
                    return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                    'category_list'=>$category_list,
                ]);
            }
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
                'category_list'=>$category_list,
            ]);
        }
    }

    /**
     * Deletes an existing Subcategory model.
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
     * Finds the Subcategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subcategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subcategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
