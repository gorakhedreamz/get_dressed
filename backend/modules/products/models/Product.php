<?php

namespace backend\modules\products\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;


/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property integer $brand_id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $discount
 * @property string $website_url
 * @property integer $featured
 * @property string $fashion
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $styles;
    public $occasions;
    public $sizes;
    public $colors;
    public $images;

    public $imageFiles;

    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['category_id', 'subcategory_id', 'brand_id', 'styles', 'occasions', 'sizes', 'colors', 'imageFiles, x, y, color)','name', 'description', 'price', 'website_url', 'fashion', 'is_activated'], 'required', 'on'=> 'backend_create_product'],
            [['category_id', 'subcategory_id', 'brand_id', 'styles', 'occasions', 'sizes', 'colors', 'name', 'description', 'price', 'website_url', 'fashion', 'is_activated'], 'required', 'on'=> 'backend_update_product'],
            
            [['category_id', 'subcategory_id', 'brand_id', 'featured', 'is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['description', 'website_url', 'fashion'], 'string'],
            [['price', 'discount'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 255],

            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category'),
            'subcategory_id' => Yii::t('app', 'Subcategory'),
            'brand_id' => Yii::t('app', 'Brand'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'discount' => Yii::t('app', 'Discount'),
            'website_url' => Yii::t('app', 'Website Url'),
            'featured' => Yii::t('app', 'Featured'),
            'fashion' => Yii::t('app', 'Fashion'),
            'is_activated' => Yii::t('app', 'Is Activated'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function uploadProduct()
    {
        $imageNames = array();

        foreach ($this->imageFiles as $file) 
        {
            $rootPath = Yii::getAlias('@rootPath');
            $nameofimage = 'banner_'.rand(1,99999999999). '.' . $file->extension;
            $pathofimage = $rootPath.'/backend/web/uploads/products/original/'.$nameofimage;
            $file->saveAs($pathofimage);
            array_push($imageNames, $nameofimage);
        }
        return $imageNames;
    }

    public function getUsercreatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'created_by']);
    }

    public function getUserupdatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updated_by']);
    }

    public static function getProductCount()
    {
        return Product::find()->where(['is_deleted' => 0])->count();
    }
}
