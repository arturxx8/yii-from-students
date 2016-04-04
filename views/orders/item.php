<?php

use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<?php Pjax::begin(['id' => 'wo13']); ?>
        Добавление нового элемента:
    <?php $form = ActiveForm::begin(['id'=> "w".$model->id,'layout' => 'horizontal','options'=>['data-pjax' => true]]);
            echo $form->field($model, 'item_id')->dropDownList($items);
            echo $form->field($model, 'amount')->textInput(['type' => 'number','value'=>'1','min'=>'1']);
            echo $form->field($model, 'id')->hiddenInput()->label(false);
            echo $form->field($model, 'order_id')->hiddenInput()->label(false);
            echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
          ActiveForm::end();?>
<?php Pjax::end(); ?>
