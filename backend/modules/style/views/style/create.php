<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\style\models\Style */

$this->title = Yii::t('app', 'Create Style');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Styles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="style-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
