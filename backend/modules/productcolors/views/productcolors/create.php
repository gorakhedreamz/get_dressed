<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productcolors\models\ProductColors */

$this->title = Yii::t('app', 'Create Product Colors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-colors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
