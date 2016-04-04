<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Employees;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

              
<div class="wrap">
    <?php
    NavBar::begin([
        'id' => 'wsa0', 
        'brandLabel' => '<img src="assets/images/logo-210x75-74.png" class="mbr-navbar__brand-img mbr-brand__img" alt="Deriabin &amp; Co.">',
        'brandUrl' => 'http://deriabin.xyz/',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top mbr-navbar--short',
        ],
    ]);
    echo Nav::widget([
        'id' => 'wsa1',
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Профиль', 'url' => ['/general/index']],
            (!yii::$app->user->isGuest)?((Employees::findOne(yii::$app->user->id)->role_id>=3)?['label'=>'События (лог)', 'url' => ['/events/index']]:''):'',
            (!\Yii::$app->user->isGuest)?([
                'id' => 'wsa3',
                'label'=> 'Заявки',
                'items'=>  [
                    ['label'=>'Добавить', 'url' => ['/orders/create']],
                    (Employees::findOne(yii::$app->user->id)->role_id>=2)?['label'=>'Входящие', 'url' => ['/orders/index']]:'',
                    (Employees::findOne(yii::$app->user->id)->role_id>=2)?['label'=>'Исходящие', 'url' => ['/orders/indexout']]:'',
                    ['label'=>'Свои', 'url' => ['/orders/indexown']],
                ]
            ]):"",
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/site/login']]
            ) : (
                [
                    'label' => 'Выход (' . Yii::$app->user->identity->login . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            )
        ],
    ]);
    NavBar::end(['id' => 'wsa5'] );
    ?>


<br><br>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>


<section class="mbr-section mbr-section--relative mbr-section--fixed-size" id="contacts1-7" style="background-color: rgb(60, 60, 60);">
    
    <div class="mbr-section__container container">
        <div class="mbr-contacts mbr-contacts--wysiwyg row">
            <div class="col-sm-4">
                <div><a href="#top"><img src="assets/images/logo-210x75-51.png" class="mbr-contacts__img mbr-contacts__img--left"></a></div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mbr-contacts__text"><strong>ADDRESS</strong><br>
199034 Биржевая Линия, 14<br>
Санкт-Петербург, Россия</p>
                    </div>
                    <div class="col-sm-4">
                        <p class="mbr-contacts__text"><strong>CONTACTS</strong><br>
Email: support@deriabin.xyz<br>
Phone: +7 (921) 883 42 36<br>
Fax: +7 (812) 633 44 36</p>
                    </div>
                    <div class="col-sm-4"><p class="mbr-contacts__text"><strong>LINKS</strong></p><ul class="mbr-contacts__list"><li><a href="http://deriabin.xyz">Главная страница</a></li><li><a href="http://deriabin.xyz/about.html">О Нас</a></li><li><a href="http://deriabin.xyz/contact.html">Контакты</a></li></ul></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
