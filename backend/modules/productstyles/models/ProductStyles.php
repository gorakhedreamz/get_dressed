<?php

namespace backend\modules\productstyles\models;

use Yii;

/**
 * This is the model class for table "tbl_product_styles".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $style_id
 */
class ProductStyles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_styles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'style_id'], 'required'],
            [['product_id', 'style_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'style_id' => Yii::t('app', 'Style ID'),
        ];
    }
}
