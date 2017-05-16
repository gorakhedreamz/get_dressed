<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\productcolors\models\ProductColors */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product Colors',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-colors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
