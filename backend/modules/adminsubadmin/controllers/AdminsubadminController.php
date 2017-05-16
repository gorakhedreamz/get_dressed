<?php

namespace backend\modules\adminsubadmin\controllers;

use Yii;
use backend\modules\adminsubadmin\models\Admin;
use backend\modules\adminsubadmin\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminsubadminController implements the CRUD actions for Admin model.
 */
class AdminsubadminController extends Controller
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
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
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Admin();
        $model->scenario = 'create_admin'; 

        if ($model->load(Yii::$app->request->post())) 
        {
            $data=Yii::$app->request->post();

            $model->password_hash = Yii::$app->security->generatePasswordHash($data['Admin']['password_hash']);
            
            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");

            $model->generateAuthKey();

            if ($model->save()) 
            {
                Yii::$app->session->setFlash('success', $model->admin_type . ' Created successfully.'); 
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
     * Updates an existing Admin model.
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
        $model->scenario = 'update_admin';

        $old_password = $model->password_hash;

        if ($model->load(Yii::$app->request->post())) 
        {
            $data=Yii::$app->request->post();

            if($old_password!=$data['Admin']['password_hash'])
            {
                $model->password_hash = Yii::$app->security->generatePasswordHash($data['Admin']['password_hash']);  
            }
            else
            {
                $model->password_hash = $old_password;
            }

            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");
            $model->generateAuthKey();

            if ($model->save()) 
            {
                Yii::$app->session->setFlash('success', $model->admin_type . ' Updated successfully.'); 
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

    public function actionUpdateprofile()
    {
         if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel(Yii::$app->user->id);
        $model->scenario = 'update_profile';
       
        $old_password = $model->password_hash;


        if ($model->load(Yii::$app->request->post())) 
        {   
            $data=Yii::$app->request->post();
         
            if($old_password!=$data['Admin']['password_hash'])
            {
                $model->password_hash = Yii::$app->security->generatePasswordHash($data['Admin']['password_hash']);  
            }
            else
            {
                $model->password_hash = $old_password;
            }

            $model->updated_date = date("Y-m-d H:i:s");
            $model->generateAuthKey();

            if ($model->save()) 
            {
                Yii::$app->session->setFlash('success','Your profile updated successfully.'); 
                return $this->goHome();
            } 
            else 
            {
                return $this->render('updateprofile', ['model' => $model,]);
            }
        } 
        else 
        {
            return $this->render('updateprofile', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Admin model.
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
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
