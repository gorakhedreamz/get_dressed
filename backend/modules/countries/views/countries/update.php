<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\countries\models\Countries */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Country',
]) . $model->country_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->country_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="countries-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
