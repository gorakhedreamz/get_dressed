<?php

namespace backend\modules\cms\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

/**
 * This is the model class for table "tbl_cms".
 *
 * @property integer $id
 * @property string $cms_type
 * @property string $cms_desc
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Cms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_type', 'cms_desc', 'is_activated'], 'required', 'on'=> 'backend_create_cms'],
            [['cms_type', 'cms_desc', 'is_activated'], 'required', 'on'=> 'backend_update_cms'],

            [['cms_type', 'cms_desc'], 'string'],
            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cms_type' => Yii::t('app', 'Cms Type'),
            'cms_desc' => Yii::t('app', 'Cms Description'),
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
