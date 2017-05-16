<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */

$this->title = "User : " . $model->first_name . " " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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

            'first_name',
            'last_name',
            'email:email',
            'username',
            'dob',
            'country.country_name',
            'device_type',

            [
                'attribute'=>'status',
                'value'=> ($model->status)== 10 ? "Active" : "InActive",
            ],

            [
                'attribute'=>'created_by',
                'value'=> ($model->created_by) ? $model->usercreatedby->first_name . " " . $model->usercreatedby->last_name:'Not created yet',
            ],

            [
                'attribute'=>'updated_by',
                'value'=> ($model->updated_by) ? $model->userupdatedby->first_name . " " . $model->userupdatedby->last_name:'Not updated yet',
            ],

            'created_date',
            'updated_date',
        ],
    ]) ?>

</div>
