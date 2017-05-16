<?php

namespace backend\modules\subcategory\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;
use backend\modules\category\models\Category;

/**
 * This is the model class for table "tbl_subcategory_master".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $subcategory_name
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_subcategory_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['category_id', 'subcategory_name', 'is_activated', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date'], 'required'],
            
            [['category_id', 'subcategory_name', 'is_activated'], 'required', 'on'=> 'backend_create_subcategory'],
            
            [['category_id', 'subcategory_name', 'is_activated'], 'required', 'on'=> 'backend_update_subcategory'],
            

            [['category_id', 'is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['subcategory_name'], 'string', 'max' => 255],
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
            'subcategory_name' => Yii::t('app', 'Subcategory Name'),
            'is_activated' => Yii::t('app', 'Is Activated'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUsercreatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'created_by']);
    }

    public function getUserupdatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updated_by']);
    }

    public static function getSubCatCount()
    {
        return Subcategory::find()->where(['is_deleted' => 0])->count();
    }
}
