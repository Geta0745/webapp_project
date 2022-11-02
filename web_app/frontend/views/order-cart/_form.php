<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;

/** @var yii\web\View $this */
/** @var app\models\OrderCart $model */
/** @var yii\widgets\ActiveForm $form */

$model->product_id = $id;
$model->user_id = Yii::$app->user->identity->id;
$model->order_date = date('Y-m-d');
if($model->isNewRecord){
    $model->amount = 1;
}
?>

<div class="order-cart-form">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>

        <?= Html::img($product->img,['style'=>"border-radius: 8px;width: 200px;"]);?>
        <hr>

        <?= $form->field($model, 'amount')->textInput(['type'=>'number','id'=>'amount']) ?>
        <?= $form->field($model, 'user_id')->textInput(['type'=>'number','id'=>'amount','readonly'=>'readonly','hidden'=>'hidden'])->label(false) ?>
        <?= $form->field($model, 'order_date')->textInput(['readonly'=>'readonly','hidden'=>'hidden'])->label(false) ?>
        <?= $form->field($model, 'product_id')->textInput(['type'=>'number','readonly'=>'readonly','hidden'=>'hidden'])->label(false) ?>
        <hr>
        <h4 id="price">ราคารวม : <?php echo $product->price; ?></h4>
        <hr>
        <div class="form-group">
            <?= Html::submitButton('Add To Cart', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<< JS
$('#amount').on('change',function(){
    if($('#amount').val() <= 0){
        $('#amount').val(1);
    }
    if(parseInt($('#amount').val()) > "{$product->current_amount}"){
        $('#amount').val("{$product->current_amount}");
    }
    $("#price").text("ราคารวม : "+parseInt("{$product->price}")*parseInt($('#amount').val()));
});

JS;

$this->registerJs($script);
?>