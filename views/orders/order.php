<?php
use yii\widgets\Pjax;
$script_onready = "
       $.ajax({ 
       url: '".Yii::$app->request->scriptUrl."?r=orders/create2', 
       type: 'post', 
       data: {
                 id : ".$model->order_id.",
                 _csrf : '".Yii::$app->request->getCsrfToken()."'
             },
       success: function (data) {
          $('#data').append('<li>'+data+'</li>');
       }
  }); 
";
$script = "
    function foo() { 
        ".$script_onready."
    }
    function foo1() { 
        var \$stuff = $('#data'),
            ajaxContent = \$stuff.html();
        
        \$stuff.on('click', '.button', function(){
            $.get('/echo/html/', function(){
                \$stuff.empty();
                console.log(\$stuff.html());
                alert(\$stuff.html()); // Look behind, #stuff is empty.
                \$stuff.html(ajaxContent);
                console.log(\$stuff.html());
            });
        });
        $.ajax({ 
       url: '".Yii::$app->request->scriptUrl."?r=orders/ready', 
       type: 'post', 
       data: {
                 id : ".$model->order_id.",
                 _csrf : '".Yii::$app->request->getCsrfToken()."'
             },
       success: function (data) {
          $('#data').append('<li>'+data+'</li>');
       }
  }); 
        window.location.replace(\"".Yii::$app->request->scriptUrl."?r=orders/indexown\");
    }
";


$this->registerJs($script, yii\web\View::POS_END);
$this->registerJs($script_onready, yii\web\View::POS_READY);
?>
<div style='display:none'>
    <?php
    Pjax::begin(['id'=>'wo13']);
    Pjax::end();
    ?>
</div>
<div class="general-order">


        <div id="data"></div>
        <a href="javascript:foo();">Добавить элемент</a>
        <a href="javascript:foo1();">Сохранить</a>
</div><!-- general-order -->
