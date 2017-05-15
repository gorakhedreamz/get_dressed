<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'id'=>'pwdhsh']) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'country_id')->dropDownList($country_list,['prompt' => 'Select Country']) ?>

    <?php //$form->field($model, 'style')->dropDownList($style_list,['multiple' => 'multiple'])->label(Yii::t('app','Service Style'));?>

    <div class="form-group">
    <label for="" class="control-label">Style</label><br>
         <?php 
            
            echo MultiSelect::widget([ 
                "options" => ['multiple'=>"multiple",'placeholder' => 'Style'], // for the actual multiselect
                'id' => "user-style",            
                'data' => $style_list, // data as array
                'value' => $model->style, // if preselected
                'name' => 'User[style]', // name for the form
                'model' => $model,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,   
                        "enableFiltering" => true
                ],
            ]);             
     
        ?>
    </div>

    <?= $form->field($model, 'status')->dropDownList([ '10' => 'Active', '0' => 'InActive', ], ['prompt' => 'Select Status']) ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS

    $('#pwdhsh').click(function(){
    $(this).select();    
    });

JS;

$this->registerJs($script);

?>