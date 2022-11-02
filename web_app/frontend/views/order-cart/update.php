<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrderCart $model */

$this->title = 'Update Order Cart: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-cart-update">

    <h1><?=Html::encode($product->product_name)?></h1>
    <p>ราคา : <?php echo $product->price; ?></p>
    <p>จำนวนที่มี : <?php echo $product->current_amount; ?></p>
    <hr>
    <?=$this->render('_form', [
    'model' => $model, 'id' => $id, 'product' => $product,
])?>

</div>