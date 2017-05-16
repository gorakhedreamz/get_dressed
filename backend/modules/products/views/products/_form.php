<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Product */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) 
{
    $subcategory_list = array();
}

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'category_id')->dropDownList($category_list, 
                     ['prompt'=>'Select Category',
                      'onchange'=>'
                                $.get( "'.Url::toRoute('getsubcategory').'", { id: $(this).val() } )
                                    .done(function( data ) {
                                        $( "#'.Html::getInputId($model, 'subcategory_id').'" ).html( data );
                                    }
                                );
                            '   
                    ]); 
                ?>

    <?= $form->field($model, 'subcategory_id')->dropDownList($subcategory_list,['prompt' => 'Select Subcategory']) ?>

    <?= $form->field($model, 'brand_id')->dropDownList($brand_list,['prompt' => 'Select Brand']) ?>

    <label>
        <?= $model->getAttributeLabel('styles');?>
    </label>

    <?= $form->field($model, 'styles')->widget(MultiSelect::classname(), [
                "options" => ['multiple'=>"multiple"],
                'data' => $style_list,
                'value' => $model->styles,
                'model' => $model,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,   
                        "enableFiltering" => true
                ],
            ])->label(false);
    ?>

    <label>
        <?= $model->getAttributeLabel('occasions');?>
    </label>

    <?= $form->field($model, 'occasions')->widget(MultiSelect::classname(), [
                "options" => ['multiple'=>"multiple"],
                'data' => $occasion_list,
                'value' => $model->occasions,
                'model' => $model,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,   
                        "enableFiltering" => true
                ],
            ])->label(false);
    ?>

    <label>
        <?= $model->getAttributeLabel('sizes');?>
    </label>

    <?= $form->field($model, 'sizes')->widget(MultiSelect::classname(), [
                "options" => ['multiple'=>"multiple"],
                'data' => $size_list,
                'value' => $model->sizes,
                'model' => $model,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,   
                        "enableFiltering" => true
                ],
            ])->label(false);
    ?>

    <label>
        <?= $model->getAttributeLabel('colors');?>
    </label>

    <?= $form->field($model, 'colors')->widget(MultiSelect::classname(), [
                "options" => ['multiple'=>"multiple"],
                'data' => $color_list,
                'value' => $model->colors,
                'model' => $model,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,   
                        "enableFiltering" => true
                ],
            ])->label(false);
    ?>

    <?php /*$form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
        'options' => ['accept' => 'imageFiles/*', 'multiple' => true],
        'attribute' => 'Product[imageFiles][]',
        'pluginOptions' => [
            'showUpload' => false,
            'previewFileType' => 'imageFiles',
        ],

    ]);*/

    ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'featured')->checkbox(); ?>

    <?= $form->field($model, 'fashion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_activated')->dropDownList([ '1' => 'Active', '0' => 'InActive', ], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
