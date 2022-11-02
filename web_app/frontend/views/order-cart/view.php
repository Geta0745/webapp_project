<?php

use app\models\Product;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
/** @var yii\web\View $this */
/** @var app\models\OrderCart $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-cart-view">
    <p>
        <?=Html::a('Cancel', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to cancel order?',
        'method' => 'post',
    ],
])?>
    </p>

    <?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'product_id',
            'label' => 'ชื่อสินค้า',
            'format' => 'raw',
            'value' => function ($model) {
                $pro = Product::find()->where(['id' => $model->product_id])->one();
                return $pro->product_name;
            },
        ],
        [
            'attribute' => 'user_id',
            'label' => 'คนสั่ง',
            'format' => 'raw',
            'value' => function ($model) {
                $user = User::find()->where(['id' => $model->user_id])->one();
                return $user->username;
            },
        ],
        'amount',
        'order_date',
    ],
])?>
    <p>
        <?=Html::a('Back', ['index'], ['class' => 'btn btn-success'])?>
    </p>

</div>