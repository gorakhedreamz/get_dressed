<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\colors\models\Color */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Color',
]) . $model->color;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->color, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="color-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
