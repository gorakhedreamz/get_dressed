<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productoccasions\models\ProductOccasions */

$this->title = Yii::t('app', 'Create Product Occasions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Occasions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-occasions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
