<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
    <div class="login-logo">
        <a href="login"><b>GET</b>DRESSED</a>
    </div>

    <div class="login-box-body">
        <div class="site-request-password-reset">
        <h2><?= Html::encode($this->title) ?></h2>

        <p>Please fill out your email. A link to reset password will be sent there.</p>
   
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
           
        </div>  
    </div>
</div>
