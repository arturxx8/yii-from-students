<?php
/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 29.03.16
 * Time: 1:20
 */
use \yii\grid\GridView;

echo GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel' => $model,
    ]
);



