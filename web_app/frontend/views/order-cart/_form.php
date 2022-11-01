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

        <?= Html::img($product->img,['style'=>"border-radius: 8px;width: 200px;"]);?><hr>

        <?= $form->field($model, 'amount')->textInput(['type'=>'number','id'=>'amount']) ?><hr>
        <h4 id="price">ราคารวม : <?php echo $product->price; ?></h4><hr>
        <div class="form-group">
            <?= Html::submitButton('Add To Cart', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<< JS
$('#amount').on('change',function(){
    $("#price").text("ราคารวม : "+parseInt("{$product->price}")*parseInt($('#amount').val()));
});

JS;

$this->registerJs($script);
?>
