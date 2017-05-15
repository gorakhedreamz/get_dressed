<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\newsfashion\models\Newsfashion */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Newsfashion',
]) . $model->nf_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsfashions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="newsfashion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
