<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title='pdf view';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
   <!--- <div class="center"><h6>ФГБОУ ВО «Бурятский государственный университет»</h6></div>--->
    <h2><?= Html::encode($this->title)?></h2>

    <table id="customer">
        <tr>
            <th>User Data ID</th>
            <th>User ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Почта</th>
            <th>Номер Телефона</th>
        </tr>
        <?php foreach($dataProvider->getModels() as $model)
        {?>
        <tr>
            <th><?= $model->user_data_id?></th>
            <th><?= $model->user_id?></th>
            <th><?= $model->user_family?></th>
            <th><?= $model->user_name?></th>
            <th><?= $model->user_patrynomic?></th>
            <th><?= $model->user_email?></th>
            <th><?= $model->user_phone?></th>
        <?php }?>

        </tr>
    </table>
</div>
 