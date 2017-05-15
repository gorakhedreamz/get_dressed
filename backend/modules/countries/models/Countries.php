<?php

namespace backend\modules\countries\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

/**
 * This is the model class for table "tbl_countries".
 *
 * @property integer $id
 * @property string $sortname
 * @property string $country_name
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['sortname', 'country_name', 'is_activated', 'is_deleted', 'created_by', 'updated_by', 'created_date', 'updated_date'], 'required'],

            [['country_name', 'is_activated'], 'required', 'on'=> 'backend_create_country'],

            [['country_name', 'is_activated'], 'required', 'on'=> 'backend_update_country'],

            [['is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['sortname'], 'string', 'max' => 3],
            [['country_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sortname' => Yii::t('app', 'Sortname'),
            'country_name' => Yii::t('app', 'Country Name'),
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
