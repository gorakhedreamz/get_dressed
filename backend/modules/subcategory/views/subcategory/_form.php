<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\subcategory\models\Subcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList($category_list,['prompt' => 'Select Category']) ?>

    <?= $form->field($model, 'subcategory_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_activated')->dropDownList([ '1' => 'Active', '0' => 'InActive', ], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
