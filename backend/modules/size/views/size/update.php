<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\size\models\Size */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Size',
]) . $model->size_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sizes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->size_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="size-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
