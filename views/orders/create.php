<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Create Orders';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $_order; ?>

</div>
