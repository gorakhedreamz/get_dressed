<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\countries\models\Countries */

$this->title = Yii::t('app', 'Create Country');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
