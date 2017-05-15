<?php

namespace backend\modules\occasion\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

/**
 * This is the model class for table "tbl_occasion".
 *
 * @property integer $id
 * @property string $occasion_name
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Occasion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_occasion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['occasion_name', 'is_activated', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date'], 'required'],
            
            [['occasion_name', 'is_activated'], 'required', 'on'=> 'backend_create_occasion'],
            [['occasion_name', 'is_activated'], 'required', 'on'=> 'backend_update_occasion'],
            
            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['occasion_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'occasion_name' => Yii::t('app', 'Occasion Name'),
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
}
