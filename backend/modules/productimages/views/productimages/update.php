<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\productimages\models\ProductImages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product Images',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
