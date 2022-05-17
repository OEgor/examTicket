<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\models\User;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use phpDocumentor\Reflection\PseudoTypes\False_;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            // 'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            'class' => 'navbar-expand-md navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest == False){
        if(Yii::$app->user->identity->user_status_id == 1)
        {
            $items = [
                ['label' => 'Пользователи', 'url' => ['/user/index']],
                ['label' => 'Данные пользователей', 'url' => ['/user-data/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Вопросы', 'url' => ['/question/index']],   
                ['label' => 'Logout('. Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' =>['data-method' => 'post']],
                ];
        }
        else
        {
            $items = [
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Личный кабинет', 'url' => ['/user-data/view']],
                ['label' => 'Вопросы', 'url' => ['/question/index']],  
                ['label' => 'Logout('. Yii::$app->user->identity->username . ')', 'url' => ['site/logout'], 'linkOptions' =>['data-method' => 'post']],
            ];

        }
    }
    else
    {
        $items = [
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],       
            ['label' => 'Login', 'url' => ['/site/login']]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'breadcrumb',//этот класс стоит по умолчанию
                    'style' => ' '
                ],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
</main>


<footer class="footer mt-auto py-3 text-muted fixed-bottom">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
