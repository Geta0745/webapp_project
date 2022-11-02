<?php
use app\models\OrderCart;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrderCart $model */
$total_price = 0;
$cart = OrderCart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
$cart2 = OrderCart::find()->where(['user_id' => Yii::$app->user->identity->id]);
$this->title = 'Check Bill';
$this->params['breadcrumbs'][] = ['label' => 'Order Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-cart-view">
    <div class="container">
        <?php
if ($cart != null) {
    echo GridView::widget([
        'dataProvider' => $dataProvider = new ActiveDataProvider(['query' => $cart2]),
        'columns' => [
            [
                'attribute' => 'product_id',
                'label' => 'ชื่อรายการ',
                'format' => 'raw',
                'value' => function ($model) {
                    $pro = Product::find()->where(['id' => $model->product_id])->one();
                    return $pro->product_name;
                },
            ],

            [
                'attribute' => 'amount',
                'label' => 'จำนวน',
                'format' => 'raw',
            ],

            [
                'attribute' => 'product_description',
                'label' => 'ราคา',
                'format' => 'raw',
                'value' => function ($model) {
                    $pro = Product::find()->where(['id' => $model->product_id])->one();
                    return $model->amount * $pro->price . " บาท";
                },
            ],
            [
                'attribute' => 'product_id',
                'format' => 'html',
                'value' => function ($model) {
                    $pro = Product::find()->where(['id' => $model->product_id])->one();
                    return Html::img($pro->img, ['width' => '100px']);
                },
            ],
        ],
    ]);
}

foreach ($cart as $row) {
    $pro = Product::find()->where(['id' => $row['product_id']])->one();
    $total_price += $pro->price * $row['amount'];
}

echo "<h2>ราคารวม : {$total_price}</h2><hr>";
?>
        <?=Html::a('จ่ายเงิน!', ['cash-bill'], ['class' => 'btn btn-success'])?>
        <?=Html::a('Cancel', ['index'], ['class' => 'btn btn-danger'])?>
    </div>
</div>