<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\banner\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="eventimg">
    <?php 

        if($model->image != "")
        {            
            echo Html::img(Yii::$app->params['url'].'backend/web/uploads/banner/original/'.$model->image,['class'=>'uploadimg', 'width'=> 400]);
            echo "<br>";
        }
            
    ?>
    </div>

    <span class="<?php if($model->image != ''){ echo "hide"; }?>" id="upnewPhoto">
    
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showUpload' => false,
            'previewFileType' => 'image',
        ],

    ]);

    ?>
    </span>
    
    <?php if($model->image != ''){ echo Html::button('Change Banner Image', ['class' => 'btn btn-primary btnupnwp', 'name' => 'upn-button','style'=>'margin-top:5px;margin-bottom:10px;']); }?>
    

    <?= $form->field($model, 'is_activated')->dropDownList([ '1' => 'Active', '0' => 'InActive', ], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
    
     $('.btnupnwp').click(function(){
          $(this).hide();
          $('#upnewPhoto').removeClass('hide');

          });


JS;

$this->registerJs($script);

?>