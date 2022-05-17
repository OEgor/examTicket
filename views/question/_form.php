<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\UserSubject;
use app\models\Subject;
use app\models\QuestionType;


/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php 
        $form = ActiveForm::begin(); 
        $id = Yii::$app->user->identity->getId();
        $sql =  
            'SELECT s.subject_id, s.subject_title 
            FROM subject AS s, user_subject AS us 
            WHERE s.subject_id = us.subject_id AND us.user_id = '.$id;
        $subjects = Subject::findBySql($sql)->all();
        $items = ArrayHelper::map($subjects,'subject_id','subject_title');

        $params = [
            'Выберите один вариант'
        ];
        echo $form->field($model, 'subject_id')->label('Предмет')->dropDownList($items, $params);

        echo $form->field($model, 'question_difficult')->label('Сложность вопроса')->textInput();

        echo $form->field($model, 'question_content')->label('Содержание вопроса')->textarea(['rows' => 6]);

        $questiontypes = QuestionType::find()->all();
        $items = ArrayHelper::map($questiontypes, 'question_type_id', 'question_type_title');
        
        echo $form->field($model, 'question_type_id')->label('Тип вопроса')->dropDownList($items, $params);

        
        if(Yii::$app->user->identity->getStatusCode() == "ADMINISTRATOR") 
            echo $form->field($model, 'creator_id')->textInput(); 
        else
            echo $form->field($model, 'creator_id')->hiddenInput(['value'=> Yii::$app->user->identity->getId()])->label(false);
        

        echo '<div class="form-group">'.Html::submitButton('Save', ['class' => 'btn btn-success']).'</div';
        ActiveForm::end();
    ?>

</div>
