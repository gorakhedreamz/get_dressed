<?php

namespace backend\modules\products\controllers;

use Yii;
use backend\modules\products\models\Product;
use backend\modules\products\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use Yii\helpers\ArrayHelper;
use backend\modules\category\models\Category;
use backend\modules\subcategory\models\Subcategory;

use backend\modules\brand\models\Brand;

use backend\modules\style\models\Style;
use backend\modules\productstyles\models\ProductStyles;

use backend\modules\occasion\models\Occasion;
use backend\modules\productoccasions\models\ProductOccasions;

use backend\modules\size\models\Size;
use backend\modules\productsizes\models\ProductSizes;

use backend\modules\colors\models\Color;
use backend\modules\productcolors\models\ProductColors;


/**
 * ProductsController implements the CRUD actions for Product model.
 */
class ProductsController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGetsubcategory($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (empty($id)) 
        {
           echo "<option value=''>Select Subcategory</option>";
        }
        else
        {
            $subcategory = Subcategory::find()
                ->where(['category_id' => $id , 'is_activated' => 1, 'is_deleted'=> 0])
                ->orderBy('category_id')
                ->all();
     
            if(count($subcategory) > 0){
                 echo "<option value=''>Select Subcategory</option>";
                foreach($subcategory as $subcategory){
                    echo "<option value='".$subcategory->id."'>".$subcategory->subcategory_name."</option>";
                }
            } 

        }
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Product();
        $model->scenario = 'backend_create_product'; 

        $category_list = Category::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $category_list = ArrayHelper::map($category_list,'id','category_name');

        $brand_list = Brand::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $brand_list = ArrayHelper::map($brand_list,'id','brand_name');

        $style_list = Style::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $style_list = ArrayHelper::map($style_list,'id','style_name');

        $occasion_list = Occasion::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $occasion_list = ArrayHelper::map($occasion_list,'id','occasion_name');

        $size_list = Size::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $size_list = ArrayHelper::map($size_list,'id','size_name');

        $color_list = Color::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $color_list = ArrayHelper::map($color_list,'id','color');

        // foreach ($color_list as $key => $value) 
        // {
        //     $color_list[$key]= '<div style="float: left;width: 300px;height: 60px;border: 2px solid rgba(0, 0, 0);background:'.$value.'"></div>';
        // }
        // echo "<pre>";

        // print_r($color_list);

        // exit();

        if ($model->load(Yii::$app->request->post())) 
        {
            $data=Yii::$app->request->post();

            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if($model->imageFiles != "")
            {   
                 $imageNames = array();
                 $imageNames = $model->uploadProduct();                
            }

            
            echo '<pre>';
            print_r($imageNames);
            exit();

            $product_styles = $data['Product']['styles'];
            $product_occasions = $data['Product']['occasions'];
            $product_sizes = $data['Product']['sizes'];
            $product_colors = $data['Product']['colors'];
            
            $model->created_by = Yii::$app->user->identity->id;
            $model->created_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                foreach ($product_styles as $key => $value) 
                {
                  $model_product_styles = new ProductStyles();
                  $model_product_styles->product_id = $model->id;
                  $model_product_styles->style_id = $value;
                  $model_product_styles->save();
                }

                foreach ($product_occasions as $key => $value) 
                {
                  $model_product_occasions = new ProductOccasions();
                  $model_product_occasions->product_id = $model->id;
                  $model_product_occasions->occasion_id = $value;
                  $model_product_occasions->save();
                }

                foreach ($product_sizes as $key => $value) 
                {
                  $model_product_sizes = new ProductSizes();
                  $model_product_sizes->product_id = $model->id;
                  $model_product_sizes->size_id = $value;
                  $model_product_sizes->save();
                }

                foreach ($product_colors as $key => $value) 
                {
                  $model_product_colors = new ProductColors();
                  $model_product_colors->product_id = $model->id;
                  $model_product_colors->color_id = $value;
                  $model_product_colors->save();
                }

                Yii::$app->session->setFlash('success','Product created successfully.'); 
                return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('create', [
                    'model' => $model,
                    'category_list'=>$category_list,
                    'brand_list'=>$brand_list,
                    'style_list'=>$style_list,
                    'occasion_list'=>$occasion_list,
                    'size_list'=>$size_list,
                    'color_list'=>$color_list,
                ]);
            }
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
                'category_list'=>$category_list,
                'brand_list'=>$brand_list,
                'style_list'=>$style_list,
                'occasion_list'=>$occasion_list,
                'size_list'=>$size_list,
                'color_list'=>$color_list,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
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
        $model->scenario = 'backend_update_product';

        $category_list = Category::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $category_list = ArrayHelper::map($category_list,'id','category_name');

        $subcategory_list = Subcategory::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0, 'category_id'=> $model->category_id])->all();
        $subcategory_list = ArrayHelper::map($subcategory_list,'id','subcategory_name');

        $brand_list = Brand::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $brand_list = ArrayHelper::map($brand_list,'id','brand_name');

        $style_list = Style::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $style_list = ArrayHelper::map($style_list,'id','style_name');


        $style_ar = ProductStyles::find()->select('style_id')->where(['product_id' => $model->id])->AsArray()->all();
        
        $style_arr = array();

        foreach ($style_ar as $key => $value) 
        {
          array_push($style_arr,$value['style_id']);
        }
      
        $model->styles = $style_arr;

        $occasion_list = Occasion::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $occasion_list = ArrayHelper::map($occasion_list,'id','occasion_name');

        $occasion_ar = ProductOccasions::find()->select('occasion_id')->where(['product_id' => $model->id])->AsArray()->all();
        
        $occasion_arr = array();

        foreach ($occasion_ar as $key => $value) 
        {
          array_push($occasion_arr,$value['occasion_id']);
        }
      
        $model->occasions = $occasion_arr;

        $size_list = Size::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $size_list = ArrayHelper::map($size_list,'id','size_name');

        $size_ar = ProductSizes::find()->select('size_id')->where(['product_id' => $model->id])->AsArray()->all();
        
        $size_arr = array();

        foreach ($size_ar as $key => $value) 
        {
          array_push($size_arr,$value['size_id']);
        }
      
        $model->sizes = $size_arr;

        $color_list = Color::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->all();
        $color_list = ArrayHelper::map($color_list,'id','color');

        $color_ar = ProductColors::find()->select('color_id')->where(['product_id' => $model->id])->AsArray()->all();
        
        $color_arr = array();

        foreach ($color_ar as $key => $value) 
        {
          array_push($color_arr,$value['color_id']);
        }
      
        $model->colors = $color_arr;

        if ($model->load(Yii::$app->request->post())) 
        {
            $data=Yii::$app->request->post();

            $product_styles = $data['Product']['styles'];
            $product_occasions = $data['Product']['occasions'];
            $product_sizes = $data['Product']['sizes'];
            $product_colors = $data['Product']['colors'];

            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_date = date("Y-m-d H:i:s");

            if ($model->save()) 
            {
                ProductStyles::deleteAll(['product_id'=>$model->id]);
                ProductOccasions::deleteAll(['product_id'=>$model->id]);
                ProductSizes::deleteAll(['product_id'=>$model->id]);
                ProductColors::deleteAll(['product_id'=>$model->id]);

                foreach ($product_styles as $key => $value) 
                {
                  $model_product_styles = new ProductStyles();
                  $model_product_styles->product_id = $model->id;
                  $model_product_styles->style_id = $value;
                  $model_product_styles->save();
                }

                foreach ($product_occasions as $key => $value) 
                {
                  $model_product_occasions = new ProductOccasions();
                  $model_product_occasions->product_id = $model->id;
                  $model_product_occasions->occasion_id = $value;
                  $model_product_occasions->save();
                }

                foreach ($product_sizes as $key => $value) 
                {
                  $model_product_sizes = new ProductSizes();
                  $model_product_sizes->product_id = $model->id;
                  $model_product_sizes->size_id = $value;
                  $model_product_sizes->save();
                }

                foreach ($product_colors as $key => $value) 
                {
                  $model_product_colors = new ProductColors();
                  $model_product_colors->product_id = $model->id;
                  $model_product_colors->color_id = $value;
                  $model_product_colors->save();
                }

                Yii::$app->session->setFlash('success','Product updated successfully.'); 
                return $this->redirect(['index']);
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                    'category_list'=>$category_list,
                    'subcategory_list'=>$subcategory_list,
                    'brand_list'=>$brand_list,
                    'style_list'=>$style_list,
                    'occasion_list'=>$occasion_list,
                    'size_list'=>$size_list,
                    'color_list'=>$color_list,
                ]);
            }
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
                'category_list'=>$category_list,
                'subcategory_list'=>$subcategory_list,
                'brand_list'=>$brand_list,
                'style_list'=>$style_list,
                'occasion_list'=>$occasion_list,
                'size_list'=>$size_list,
                'color_list'=>$color_list,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
