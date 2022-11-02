<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true])->label('ชื่อสินค้า') ?>

    <?= $form->field($model, 'product_description')->textInput(['maxlength' => true])->label('รายละเอียด') ?>

    <?= $form->field($model, 'price')->textInput(['type'=>'number','id'=>'price'])->label('ราคา') ?>

    <?= $form->field($model, 'current_amount')->textInput(['type'=>'number','id'=>'amount'])->label('จำนวน') ?>
    <br>
    <?php echo $form->field($model, 'file')->fileInput(['class'=>'form-control','disabled'=>$model->img != null])->label(false); 
    if($model->img != null){
        echo '<br><p>You already have Image</p>';
    }
    ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS
$('#amount').on('change',function(){
    if($('#amount').val() < 0){
        $('#amount').val(0);
    }
});

$('#price').on('change',function(){
    if($('#price').val() < 0){
        $('#price').val(0);
    }
});

JS;

$this->registerJs($script);
?>