<?php

use app\models\OrderCart;
use app\models\Product;
use common\models\User;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\OrderCartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ตระกร้าสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-cart-index">

    <h1><?=Html::encode($this->title)?></h1><hr>

    <p>
        <?=Html::a('Check Bill', ['bill'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
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
        [
            'attribute' => 'amount',
            'label' => 'จำนวน',
            'format' => 'raw',
        ],
        [
            'attribute' => 'order_date',
            'label' => 'วันที่สั่ง',
            'format' => 'raw',
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, OrderCart $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            },
            'template' => '{view} {delete}',
        ],
    ],
]);?>

</div>