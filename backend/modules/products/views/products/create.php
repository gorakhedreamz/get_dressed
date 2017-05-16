<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Product */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'category_list'=>$category_list,
        'brand_list'=>$brand_list,
        'style_list'=>$style_list,
        'occasion_list'=>$occasion_list,
        'size_list'=>$size_list,
        'color_list'=>$color_list,
    ]) ?>

</div>
