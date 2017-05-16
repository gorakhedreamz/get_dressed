<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\style\models\Style */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Style',
]) . $model->style_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Styles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->style_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="style-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
