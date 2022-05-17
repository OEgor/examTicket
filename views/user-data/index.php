<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\UserData;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Data', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export PDF', ['pdf'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_data_id',
            'user_id',
            'user_family',
            'user_name',
            'user_patrynomic',
            //'user_email:email',
            //'user_phone',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_data_id' => $model->user_data_id]);
                 }
            ],
        ],
    ]); ?>


</div>
