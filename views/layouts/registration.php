<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>BRASIL API | CRIE SUA CONTA</title>
    <?php $this->head() ?>
    <style type="text/css">
        html, body {
            background: #eee;
            -webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
            box-shadow: inset 0 0 100px rgba(0,0,0,.5);
            height: 100%;
            min-height: 100%;
            position: relative;
        }

    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    

    <div class="container text-center">
        <hr/>
        <h3 class="text-center">
            <b>BRASIL API</b>
            |
            <small>CRIE SUA CONTA</small>

        </h3>
        <a href="/">Voltar ao site</a>
        |
        <a href="/user-management/auth/login"> Fazer login (Entrar)</a>

        <hr/>
        <?= $content ?>
        <hr/>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
