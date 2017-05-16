<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\adminsubadmin\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admins & Subadmins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Admin/Subadmin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'first_name',
            'last_name',
            
            //'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            [
                'attribute'=>'admin_type',
                // /'filter'=>array("Super Admin"=>"Super Admin","Sub Admin"=>"Sub Admin" , "prompt" => "Show All"),
                'filter' => Html::activeDropDownList($searchModel, 'admin_type', ["Admin"=>"Admin","Subadmin"=>"Subadmin"],['class'=>'form-control','prompt' => 'Show All']),
            ],            
            // 'last_logout',
            // 'status',

            [
                'attribute'=>'status',
                'value'=>function ($data) 
                {
                    return $data->status=='0' ? 'In-active' : 'Active';
                },

                'filter' => Html::activeDropDownList($searchModel, 'status', [10=>"Active", 0=>"InActive"],['class'=>'form-control','prompt' => 'Show All']),
            ],
            // 'is_deleted',
            // 'created_by',
            // 'updated_by',
            // 'created_date',
            // 'updated_date',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
