<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://latex.codecogs.com/css/equation-embed.css"/>
        <script src="https://latex.codecogs.com/js/eq_config.js"></script>
        <script src="https://latex.codecogs.com/js/eq_editor-lite-19.js"></script>
        <title>Document</title>
    </head>
    <body>
        <div id="toolbar"></div>
        <textarea id="testbox" rows="3" cols="40"></textarea>
        <img id="equation" />

        <p>
            <input id="copybutton" type="button" class="greybutton" value="Export Button 1" />
            <input id="copybutton2" type="button" class="greybutton" value="Export Button 2" />
        </p>

        <textarea id="buttonexport" rows="3" cols="40"></textarea>

        <script type="text/javascript">
            EqEditor.embed('toolbar');
            var a=new EqTextArea('equation', 'testbox');
            EqEditor.add(a,false);

            EqnExport=function(text) { EqEditor.addText(document, 'buttonexport', text); };
            EqEditor.ExportButton.add(a, 'copybutton', EqnExport, 'html');

            EqnExport2=function(text) { alert(text); };
            EqEditor.ExportButton.add(a, 'copybutton2', EqnExport2, 'html');
        </script>
    </body>
</html>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */


$this->title = 'Добавление вопроса';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
