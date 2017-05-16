<?php

namespace backend\modules\productsizes\models;

use Yii;

/**
 * This is the model class for table "tbl_product_sizes".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $size_id
 */
class ProductSizes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_sizes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'size_id'], 'required'],
            [['product_id', 'size_id'], 'integer'],
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
            'size_id' => Yii::t('app', 'Size ID'),
        ];
    }
}
