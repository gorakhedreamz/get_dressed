<?php

namespace backend\modules\category\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

/**
 * This is the model class for table "tbl_category_master".
 *
 * @property integer $id
 * @property string $category_name
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_category_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['category_name', 'is_activated', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date'], 'required'],
            
            [['category_name', 'is_activated'], 'required', 'on'=> 'backend_create_category'],
            
            [['category_name', 'is_activated'], 'required', 'on'=> 'backend_update_category'],
            

            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_name' => Yii::t('app', 'Category Name'),
            'is_activated' => Yii::t('app', 'Is Activated'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    public function getUsercreatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'created_by']);
    }

    public function getUserupdatedby()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updated_by']);
    }

    public static function getCatCount()
    {
        return Category::find()->where(['is_deleted' => 0])->count();
    }
}
