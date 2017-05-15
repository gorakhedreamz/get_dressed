<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use Yii\helpers\ArrayHelper;
use backend\modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\subcategory\models\SubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subcategories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategory-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Subcategory'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'category_id',
                'value'=>'category.category_name',
                'filter' => Html::activeDropDownList($searchModel, 'category_id', ArrayHelper::map(Category::find()->where(['is_activated'=> 1 , 'is_deleted'=> 0])->asArray()->all(), 'id', 'category_name'),['class'=>'form-control','prompt' => 'Show All']),
            ],

            'subcategory_name',

            [
                'attribute'=>'is_activated',
                'value'=>function ($data) 
                {
                    return $data->is_activated=='0' ? 'InActive' : 'Active';
                },

                'filter' => Html::activeDropDownList($searchModel, 'is_activated', [ 1 =>"Active", 0 =>"InActive"],['class'=>'form-control','prompt' => 'Show All']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
