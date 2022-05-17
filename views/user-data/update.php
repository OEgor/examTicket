<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserData */

$this->title = 'Update User Data: ' . $model->user_data_id;
$this->params['breadcrumbs'][] = ['label' => 'User Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_data_id, 'url' => ['view', 'user_data_id' => $model->user_data_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
        