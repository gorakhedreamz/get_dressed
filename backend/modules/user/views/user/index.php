<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use Yii\helpers\ArrayHelper;
use backend\modules\countries\models\Countries;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'first_name',
            'last_name',
            'email:email',

            [
                'attribute'=>'country_id',
                'value'=>'country.country_name',
                'filter' => Html::activeDropDownList($searchModel, 'country_id', ArrayHelper::map(Countries::find()->where(['is_activated'=>1 , 'is_deleted'=> 0])->asArray()->all(), 'id', 'country_name'),['class'=>'form-control','prompt' => 'Show All']),
            ],

            [
                'attribute'=>'status',
                'value'=>function ($data) 
                {
                    return $data->status=='0' ? 'InActive' : 'Active';
                },

                'filter' => Html::activeDropDownList($searchModel, 'status', [ 10 =>"Active", 0 =>"InActive"],['class'=>'form-control','prompt' => 'Show All']),
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
