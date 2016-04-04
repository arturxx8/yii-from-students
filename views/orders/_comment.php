<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$form = ActiveForm::begin(['action'=>['event']]); ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'event_id')->hiddenInput()->label(false)?>
    <div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>