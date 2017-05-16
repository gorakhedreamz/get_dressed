<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\newsfashion\models\Newsfashion */

$this->title = Yii::t('app', 'Create Newsfashion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsfashions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfashion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
