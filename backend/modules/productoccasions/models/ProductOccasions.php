<?php

namespace backend\modules\productoccasions\models;

use Yii;

/**
 * This is the model class for table "tbl_product_occasions".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $occasion_id
 */
class ProductOccasions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_occasions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'occasion_id'], 'required'],
            [['product_id', 'occasion_id'], 'integer'],
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
            'occasion_id' => Yii::t('app', 'Occasion ID'),
        ];
    }
}
