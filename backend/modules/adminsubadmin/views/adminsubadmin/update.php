<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\adminsubadmin\models\Admin */

$this->title = Yii::t('app', 'Update {modelClass} : ', [
    'modelClass' => 'Admin / Subadmin',
]) . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="admin-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
