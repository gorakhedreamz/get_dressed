<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\Cms */

$this->title = Yii::t('app', 'Create CMS Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
