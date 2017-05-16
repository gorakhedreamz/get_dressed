<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\brand\models\Brand */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Brand',
]) . $model->brand_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->brand_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
