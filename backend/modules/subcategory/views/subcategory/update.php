<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\subcategory\models\Subcategory */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Subcategory',
]) . $model->subcategory_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subcategories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subcategory_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="subcategory-update">

    <?= $this->render('_form', [
        'model' => $model,
        'category_list'=>$category_list,
    ]) ?>

</div>
