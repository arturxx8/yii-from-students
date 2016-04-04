<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'comment:ntext',
            'employee.fio',
            'department.department_name',
            'statuses.status_name',
            /*[
                'attribute'=>'orderedItems.amount',

                'value' => function($model) {
                    $arr="not set";
                    foreach ($model->orderedItems as $item){
                        if ($arr=="not set") {
                            $arr='';
                        }
                        $itm=$item->item;

                        Yii::info($itm,'binary');
                        $arr.=$item->item->item_name.'|'.$item->amount.";</br>";
                    }
                    return $arr;
                }
            ],*/

            [
                'class' => \yii\grid\ActionColumn::className(),
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['orders/view','id'=>$model->order_id]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                            ['title' => Yii::t('yii', 'Просмотреть'), 'data-pjax' => '0']);
                    },
                    'update'=>function ($url, $model) {return '';},
                    'delete'=>function ($url, $model){return '';},
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
