<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productstyles\models\ProductStyles */

$this->title = Yii::t('app', 'Create Product Styles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Styles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-styles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
