<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\newsfashion\models\NewsfashionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News Fashions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsfashion-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Newsfashion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'nf_title',
                'format' => 'raw', 
                'contentOptions'=>['style'=>'max-width: 400px; white-space:normal'],
            ],


            [
                'format' => 'html',
                'label' => 'News Fashion Image',
                'value' => function ($data) 
                {
                    return Html::img(Yii::$app->params['url'].'backend/web/uploads/newsfashion/original/'.$data['nf_image'],['width' => '250px' , 'height' => '200px' ]);
                },
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
<?php Pjax::end(); ?></div>
