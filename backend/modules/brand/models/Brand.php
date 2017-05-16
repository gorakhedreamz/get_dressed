<?php

namespace backend\modules\brand\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

/**
 * This is the model class for table "tbl_brand".
 *
 * @property integer $id
 * @property string $brand_name
 * @property string $brand_details
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['brand_name', 'brand_details', 'is_activated', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date'], 'required'],

            [['brand_name', 'brand_details', 'is_activated'], 'required', 'on'=> 'backend_create_brand'],
            [['brand_name', 'brand_details', 'is_activated'], 'required', 'on'=> 'backend_update_brand'],

            [['brand_details'], 'string'],
            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['brand_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'brand_name' => Yii::t('app', 'Brand Name'),
            'brand_details' => Yii::t('app', 'Brand Details'),
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

    public static function getBrandCount()
    {
        return Brand::find()->where(['is_deleted' => 0])->count();
    }
}
