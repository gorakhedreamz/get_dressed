<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\Cms */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'CMS Page',
]) . $model->cms_type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cms_type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
