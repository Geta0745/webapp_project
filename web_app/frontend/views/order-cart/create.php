<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrderCart $model */

$this->title = 'Create Order Cart';
$this->params['breadcrumbs'][] = ['label' => 'Order Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-cart-create">

    <h1><?= Html::encode($product->product_name) ?></h1>
    <p>ราคา <?php echo $product->price; ?></p>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,'id'=>$id,'product'=>$product,
    ]) ?>

</div>
