<?php

/** @var yii\web\View $this */
use app\models\Product;
use yii\helpers\Html;

$model = Product::find()->all();
$this->title = 'Home';
?>
<div class="site-index">
    <div class="container">
        <h2>Order</h2><hr><br>
        <div class="row">
            <?php
if ($model != null) {
    foreach ($model as $row) {
        echo '<div class="card" style="width: 18rem;">';
        echo '<div class="card-header"><h3>'.$row['product_name'].'</h3></div>';
        echo '<img class="card-img-top" style="border-radius: 8px;width: 200px;" src="' . $row['img'] . '" alt="'.$row['product_name'].'">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['price'] . ' บาท</h5>';
        echo '<p class="card-text">' . $row['product_description'] . '</p>';
        echo Html::a('Yaa', ['order-cart/create','id'=>$row['id']], ['class' => 'btn btn-primary']);
        echo '</div></div>';
    }
}
?>
        </div><hr>
    </div>
</div>