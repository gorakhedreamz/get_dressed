<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\userstyles\models\Userstyles */

$this->title = Yii::t('app', 'Create Userstyles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Userstyles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userstyles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
