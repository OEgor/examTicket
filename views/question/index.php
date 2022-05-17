<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить вопрос', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сгенерировать билеты', ['pdf'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        if(Yii::$app->user->identity->getStatusCode() == "ADMINISTRATOR")
        {

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'question_id',
                    'subject_id',
                    'question_difficult',
                    'question_content:ntext',
                    'question_type_id',
                    'creator_id',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'question_id' => $model->question_id]);
                        }
                    ],
                ],
            ]);
         }
         else
         {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'question_id',
                    [
                        'label' => 'Предмет',
                        'attribute' => 'subjectTitle',
                        'value' => 'subject.subject_title'
                    ],
                    //'question_difficult',
                    [
                        'label' => 'Сложность',
                        'attribute' => 'questionDifficult',
                        'value' => 'question_difficult'
                    ],
                    // 'question_content:ntext',
                    [
                        'label' => 'Вопрос',
                        'attribute' => 'questionContent',
                        'value' => 'question_content'
                    ],
                    //'question_type_id',
                    [
                        'label' => 'Тип вопроса',
                        'attribute' => 'questionType',
                        'value' => 'questionType.question_type_title'
                        //'question_type_id',
                    ],
                    //'creator_id',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'question_id' => $model->question_id]);
                        }
                    ],
                ],
            ]);   
         }
     ?>


</div>
