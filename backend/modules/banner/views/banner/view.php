<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\banner\models\Banner */

$this->title = "Banner : " . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        $imagepath =  Yii::$app->params['url'].'backend/web/uploads/banner/original/'.$model->image;
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute'=>'image',
                'value'=>$imagepath,
                'format' => ['image',['height'=>'200']],
            ],            
            
            [
             'attribute'=>'Is Actived', 
             'value' => ($model->is_activated=='0' ? 'InActive' : 'Active'),
            ],

            [
                'attribute'=>'created_by',
                'value'=> ($model->created_by)?$model->usercreatedby->first_name . " " . $model->usercreatedby->last_name:'',
            ],

            [
                'attribute'=>'updated_by',
                'value'=> ($model->updated_by)?$model->userupdatedby->first_name . " " . $model->userupdatedby->last_name:'Not updated yet',
            ],

            'created_date',
            'updated_date',
        ],
    ]) ?>

</div>
