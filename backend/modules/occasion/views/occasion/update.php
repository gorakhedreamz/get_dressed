<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\occasion\models\Occasion */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Occasion',
]) . $model->occasion_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Occasions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->occasion_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="occasion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
