<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AdminLoginForm;


use common\models\PasswordResetRequestFormadmin;
use common\models\ResetPasswordFormadmin;

use backend\modules\adminsubadmin\models\Admin;

/**
 * Site controller
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
                        'actions' => ['login', 'error','request-password-reset','reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $tot_categories =  \backend\modules\category\models\Category::getCatCount();
        $tot_sub_categories =  \backend\modules\subcategory\models\Subcategory::getSubCatCount();
        $tot_brands =  \backend\modules\brand\models\Brand::getBrandCount();
        $tot_products =  \backend\modules\products\models\Product::getProductCount();
        $tot_users =  \backend\modules\user\models\User::getUserCount();

        return $this->render('index',['tot_categories' => $tot_categories, 'tot_sub_categories' => $tot_sub_categories, 'tot_brands' => $tot_brands, 'tot_products' => $tot_products, 'tot_users' => $tot_users ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            return $this->goBack();
        } 
        else 
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $model = Admin::find()->where(['id'=>Yii::$app->user->identity->id])->one();

        $model->last_logout = date('Y-m-d H:i:s');

        $model->save(false);

        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $this->layout = '//main-login';
        
        $model = new PasswordResetRequestFormadmin();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {

            if ($model->sendEmail()) 
            {
                Yii::$app->session->setFlash('success', "Check your email for further instructions.");
                return $this->goBack();
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                return $this->goBack();
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = '//main-login';
        try 
        {
            $model = new ResetPasswordFormadmin($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) 
        {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
