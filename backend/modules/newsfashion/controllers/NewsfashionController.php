<?php

namespace backend\modules\newsfashion\controllers;

use Yii;
use backend\modules\newsfashion\models\Newsfashion;
use backend\modules\newsfashion\models\NewsfashionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * NewsfashionController implements the CRUD actions for Newsfashion model.
 */
class NewsfashionController extends Controller
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
     * Lists all Newsfashion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new NewsfashionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Newsfashion model.
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
     * Creates a new Newsfashion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Newsfashion();
        $model->scenario = 'backend_create_newsfashion'; 

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->nf_image = UploadedFile::getInstance($model, 'nf_image');  

            if($model->nf_image != "")
            {   
                 $model->uploadImage();                
            }

            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                Yii::$app->session->setFlash('success','News Fashion created successfully.'); 
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
     * Updates an existing Newsfashion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id);
        $model->scenario = 'backend_update_newsfashion'; 
        $oldimage = $model->nf_image;

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->nf_image = UploadedFile::getInstance($model, 'nf_image');  

            if($model->nf_image != "")
            {   
                 $model->uploadImage();                
            }
            else
            {
                $model->nf_image = $oldimage;
            }

            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                if ($model->nf_image!=$oldimage) 
                {
                     $rootPath = Yii::getAlias('@rootPath');
                     $orgimage = $rootPath.'/backend/web/uploads/newsfashion/original/' .$oldimage;
                    //$thumbimage = $rootPath.'/frontend/web/uploads/facility/thumb_300X234/' .$oldimage;

                    if (!empty($oldimage)) 
                    {
                         if (file_exists($orgimage)) 
                         {
                            unlink($orgimage);
                         }
                    }
                }

                Yii::$app->session->setFlash('success','News Fashion updated successfully.'); 
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
     * Deletes an existing Newsfashion model.
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
        $model->is_deleted = "1";
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Newsfashion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Newsfashion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newsfashion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
