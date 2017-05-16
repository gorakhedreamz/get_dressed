<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
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

    <?= $form->field($model, 'dob')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Date Of Birth'],
            'pluginOptions' => [
                 'autoclose' => true,
                 'format' => 'yyyy-mm-dd', 
                 'endDate'=>date('Y-m-d'),
            ]
        ]);
    ?>

    <?= $form->field($model, 'country_id')->dropDownList($country_list,['prompt' => 'Select Country']) ?>

    <label>
        <?= $model->getAttributeLabel('style');?>
    </label>

    <?= $form->field($model, 'style')->widget(MultiSelect::classname(), [
                "options" => ['multiple'=>"multiple"],
                //'id' => "user-style",            
                'data' => $style_list,
                'value' => $model->style,
                //'name' => 'User[style]',
                'model' => $model,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,   
                        "enableFiltering" => true
                ],
            ])->label(false);
    ?>

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