<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\faq\models\Faq */

$this->title = Yii::t('app', 'Create FAQ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
