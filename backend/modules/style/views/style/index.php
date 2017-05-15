<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\style\models\StyleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Styles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="style-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Style'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'style_name',
            [
                'attribute'=>'is_activated',
                'value'=>function ($data) 
                {
                    return $data->is_activated=='0' ? 'InActive' : 'Active';
                },

                'filter' => Html::activeDropDownList($searchModel, 'is_activated', [1=>"Active", 0=>"InActive"],['class'=>'form-control','prompt' => 'Show All']),
            ],
            //'is_deleted',
            //'created_by',
            // 'updated_by',
            // 'created_date',
            // 'updated_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
