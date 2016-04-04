<?php
use yii\widgets\Pjax;

$script = "
    function foo() { 
        $.ajax({ 
       url: '".Yii::$app->request->scriptUrl."?r=general/order', 
       type: 'post', 
       data: {
                 id : ".$order_id.",
                 _csrf : '".Yii::$app->request->getCsrfToken()."'
             },
       success: function (data) {
          $('#data').append('<li>'+data+'</li>');
       }
  }); 
    }
";
$script_onready = "
        $.ajax({ 
       url: '".Yii::$app->request->scriptUrl."?r=general/order', 
       type: 'post', 
       data: {
                 id : ".$order_id.",
                 _csrf : '".Yii::$app->request->getCsrfToken()."'
             },
       success: function (data) {
          $('#data').append('<li>'+data+'</li>');
       }
  }); 
";
$this->registerJs($script, yii\web\View::POS_END);
$this->registerJs($script_onready, yii\web\View::POS_READY);
?>
<div style='display:none'>
    <?php
    Pjax::begin();
    Pjax::end();
    ?>
</div>
<div class="general-order">
    Заказ #<?=$order_id?>
        <div id="data"></div>
        <a href="javascript:foo();">Добавить элемент</a>
</div><!-- general-order -->
