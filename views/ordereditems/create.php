<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderedItems */

$this->title = 'Create Ordered Items';
$this->params['breadcrumbs'][] = ['label' => 'Ordered Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordered-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
