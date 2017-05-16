<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\colors\models\ColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Colors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Color'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'header'=>'Color',
                'value'=>function ($data) 
                {
                    return '<div style="float: left;width: 300px;height: 60px;border: 2px solid rgba(0, 0, 0);background:'.$data->color.'"></div>';
                },
                'format'=>'raw',
            ],


            [
                'attribute'=>'is_activated',
                'value'=>function ($data) 
                {
                    return $data->is_activated=='0' ? 'InActive' : 'Active';
                },

                'filter' => Html::activeDropDownList($searchModel, 'is_activated', [1=>"Active", 0=>"InActive"],['class'=>'form-control','prompt' => 'Show All']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
