<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\User;
use backend\modules\user\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Yii\helpers\ArrayHelper;
use backend\modules\countries\models\Countries;
use backend\modules\style\models\Style;
use backend\modules\userstyles\models\Userstyles;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        $model->scenario = 'backend_create_user';

        $country_list = Countries::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $country_list = ArrayHelper::map($country_list,'id','country_name');

        $style_list = Style::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $style_list = ArrayHelper::map($style_list,'id','style_name');



        if ($model->load(Yii::$app->request->post())) 
        {
            $data=Yii::$app->request->post();

            $user_styles = $data['User']['style'];

            $model->password_hash = Yii::$app->security->generatePasswordHash($data['User']['password_hash']);  

            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");
            $model->generateAuthKey();


            if ($model->save()) 
            {
                foreach ($user_styles as $key => $value) 
                {
                  $nearby = new Userstyles();
                  $nearby->user_id = $model->id;
                  $nearby->style_id = $value;
                  $nearby->save();
                }

                Yii::$app->session->setFlash('success','New user created successfully.'); 
                return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                    'country_list'=>$country_list,
                    'style_list'=>$style_list,
                ]);
            }
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
                'country_list'=>$country_list,
                'style_list'=>$style_list,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
        $model->scenario = 'backend_update_user';

        $old_password = $model->password_hash;

        $country_list = Countries::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $country_list = ArrayHelper::map($country_list,'id','country_name');

        $style_list = Style::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $style_list = ArrayHelper::map($style_list,'id','style_name');

        $style_ar = Userstyles::find()->select('style_id')->where(['user_id' => $model->id])->AsArray()->all();
        
        $style_arr = array();

        foreach ($style_ar as $key => $value) 
        {
          array_push($style_arr,$value['style_id']);
        }
      
        $model->style = $style_arr;

        if ($model->load(Yii::$app->request->post())) 
        {
            $data=Yii::$app->request->post();

            $user_styles = isset($data['User']['style']) ?  $data['User']['style'] : '';

            if($old_password!=$data['User']['password_hash'])
            {
                $model->password_hash = Yii::$app->security->generatePasswordHash($data['User']['password_hash']);  
            }
            else
            {
                $model->password_hash = $old_password;
            }

            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                Userstyles::deleteAll(['user_id'=>$model->id]);

                foreach ($user_styles as $key => $value) 
                {
                  $nearby = new Userstyles();
                  $nearby->user_id = $model->id;
                  $nearby->style_id = $value;
                  $nearby->save();
                }


                Yii::$app->session->setFlash('success','User updated successfully.'); 
                return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                    'country_list'=>$country_list,
                    'style_list'=>$style_list,
                ]);
            }
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
                'country_list'=>$country_list,
                'style_list'=>$style_list,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
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
