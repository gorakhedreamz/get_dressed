<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\adminsubadmin\models\Admin */

$this->title = Yii::t('app', 'Create Admin / Subadmin');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
