<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Subject;
use app\models\QuestionType;
use app\models\Question;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Вопрос №'.$model->question_id;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'question_id' => $model->question_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'question_id' => $model->question_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
        
    <?php
        if(Yii::$app->user->identity->getStatusCode() == "ADMINISTRATOR")
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'question_id',
                    'subject_id',
                    'question_difficult',
                    'question_content:ntext',
                    'question_type_id',
                    'creator_id',
                ],
            ]);
        else
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'question_id',
                    [
                        'label' => 'Предмет',
                        'attribute' => 'subject_title',
                        'value' => Subject::getSubjectTitle($model->subject_id)
                    ],
                    [

                        'label' => 'Сложность вопроса',
                        'attribute' => 'question_difficult',
                        'value' => $model->question_difficult
                    ],
                    [

                        'label' => 'Вопрос',
                        'attribute' => 'question_content:ntext',
                        'value' => $model->question_content
                    ],
                    [
                        'label' => 'Тип вопроса',
                        'attribute' => 'question_type_title',
                        'value' => QuestionType::getQuestionTypeTitle($model->question_type_id)
                    ]
                    //'creator_id',
                ],
            ]);
     ?>

</div>
