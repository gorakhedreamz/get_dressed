<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\faq\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'FAQ\'s');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Faq'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute'=>'faq_que',
                'format' => 'raw', 
                'contentOptions'=>['style'=>'max-width: 800px; white-space:normal'],
            ],

            // 'faq_answer:ntext',
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
