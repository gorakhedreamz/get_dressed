<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\colors\models\Color */

$this->title = "Color : " . $model->color;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [


            [
              'attribute' => 'color',

              'value' => call_user_func(function($model) 
                        {
                            return '<div style="float: left;width: 300px;height: 60px;border: 2px solid rgba(0, 0, 0);background:'.$model->color.'"></div>';
                        }
                        , $model),
              'format'=> 'raw',
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
