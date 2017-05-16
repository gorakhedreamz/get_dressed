<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\adminsubadmin\models\Admin */

$this->title =  $model->admin_type. " : " . $model->first_name . " " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

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
            'username',
            'email:email',
            'admin_type',
            'last_logout',
            
            [
             'attribute'=>'status', 
             'value' => ($model->status=='0' ? 'In-active' : 'Active'),
            ],  

            [
                'attribute'=>'created_by',
                'value'=> ($model->created_by)?$model->usercreatedby->first_name . " " . $model->usercreatedby->last_name:'',
            ],
            'created_date',
            [
                'attribute'=>'updated_by',
                'value'=> ($model->updated_by)?$model->userupdatedby->first_name . " " . $model->userupdatedby->last_name:'Not updated yet',
            ],
            'updated_date',
        ],
    ]) ?>

</div>
