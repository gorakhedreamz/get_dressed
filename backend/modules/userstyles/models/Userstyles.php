<?php

namespace backend\modules\userstyles\models;

use Yii;

/**
 * This is the model class for table "tbl_user_styles".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $style_id
 */
class Userstyles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_styles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'style_id'], 'required'],
            [['user_id', 'style_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'style_id' => Yii::t('app', 'Style ID'),
        ];
    }
}
