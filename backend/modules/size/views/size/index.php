<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\size\models\SizeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sizes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Size'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'size_name',
            
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
<?php Pjax::end(); ?></div>
