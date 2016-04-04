<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderedItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordered Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordered-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item.item_name',
            'amount',
            'item.unit'
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
