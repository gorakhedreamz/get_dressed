<?php

namespace backend\modules\faq\models;

use Yii;
use backend\modules\adminsubadmin\models\Admin;

/**
 * This is the model class for table "tbl_faq".
 *
 * @property integer $id
 * @property string $faq_que
 * @property string $faq_answer
 * @property integer $is_activated
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $updated_date
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['faq_que', 'faq_answer', 'is_activated',], 'required', 'on'=> 'backend_create_faq'],
            [['faq_que', 'faq_answer', 'is_activated',], 'required', 'on'=> 'backend_update_faq'],

            [['faq_que','faq_answer'], 'string'],
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
            'faq_que' => Yii::t('app', 'FAQ Question'),
            'faq_answer' => Yii::t('app', 'FAQ Answer'),
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
