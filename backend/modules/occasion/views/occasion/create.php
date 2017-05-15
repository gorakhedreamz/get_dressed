<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\occasion\models\Occasion */

$this->title = Yii::t('app', 'Create Occasion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Occasions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occasion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
