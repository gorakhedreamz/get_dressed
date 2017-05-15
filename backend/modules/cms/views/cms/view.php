<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\cms\models\Cms */

$this->title = "CMS Page : " . $model->cms_type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'cms_type',
            'cms_desc:html',
            
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
