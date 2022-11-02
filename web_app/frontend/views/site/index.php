<?php

/** @var yii\web\View $this */
use app\models\Product;
use yii\helpers\Html;

$model = Product::find()->having(['>', 'current_amount', 0])->orderBy(['price' => 'SORT_DESC'])->all();
$this->title = 'Home';
?>
<div class="site-index">
    <div class="container">
        <h2>รายการสินค้า</h2><hr><br>
        <div class="row">
            <?php
if ($model != null) {
    foreach ($model as $row) {
        echo '<div class="card" style="width: 18rem;margin-right: 10px;margin-left: 10px;margin-top: 10px;margin-bottom: 10px;">';
        echo '<div class="card-header"><h3>'.$row['product_name'].' ('.$row['current_amount'].' ชิ้น)'.'</h3></div>';
        echo '<img class="card-img-top" style="border-radius: 8px;width: 200px;" src="' . $row['img'] . '" alt="'.$row['product_name'].'">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'; if($row['price'] == 0){echo 'Free!';}else{echo $row['price'].' บาท</h5>';} ;
        echo '<p class="card-text">' . $row['product_description'] . '</p>';
        echo Html::a('ซื้อเลย!', ['order-cart/create','id'=>$row['id']], ['class' => 'btn btn-success']);
        echo '</div></div>';
    }
}
?>
        </div><hr>
    </div>
</div>