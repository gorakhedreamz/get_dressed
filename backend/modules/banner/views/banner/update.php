<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\banner\models\Banner */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Banner',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="banner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
