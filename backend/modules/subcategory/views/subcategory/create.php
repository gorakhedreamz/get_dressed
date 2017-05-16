<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\subcategory\models\Subcategory */

$this->title = Yii::t('app', 'Create Subcategory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subcategories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-create">

    <?= $this->render('_form', [
        'model' => $model,
        'category_list'=>$category_list,
    ]) ?>

</div>
