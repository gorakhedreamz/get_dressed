<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\Admin */

$this->title = Yii::t('app', 'Update Profile');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'id'=>'pwdhash']) ?>

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

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
        $('#pwdhash').click(function(){
            $(this).select();
        });
JS;

$this->registerJs($script);

?>