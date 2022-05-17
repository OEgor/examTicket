<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserData */

$this->title = $model->user_family.' '.$model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-data-view">
    <div class="row">
        <div class="col-lg-6">

            
            <h1><?= Html::encode($this->title) ?></h1>
        
            <p>
                <?= Html::a('Изменить данные', ['update', 'user_data_id' => $model->user_data_id], ['class' => 'btn btn-primary']) ?>
                <?php
                    if(Yii::$app->user->identity->getStatusCode() == "ADMINISTRATOR")
                        echo Html::a('Delete', ['delete', 'user_data_id' => $model->user_data_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                ?>
        
            </p>
            <?php
                if(Yii::$app->user->identity->getStatusCode() == "ADMINISTRATOR")
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'user_data_id',
                            'user_id',
                            'user_family',
                            'user_name',
                            'user_patrynomic',
                            'user_email:email',
                            'user_phone',
                        ],
                    ]);
                else
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'user_family',
                            'user_name',
                            'user_patrynomic',
                            'user_email:email',
                            'user_phone',
                        ],
                    ]);
            ?>
        </div>
    </div>
</div>
