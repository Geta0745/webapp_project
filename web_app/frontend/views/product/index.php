<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id',
                'label'=>'รหัสสินค้า',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->id;
                }
            ],
            
            [
                'attribute'=>'product_name',
                'label'=>'ชื่อสินค้า',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->product_name;
                }
            ],

            [
                'attribute'=>'product_description',
                'label'=>'รายละเอียด',
            ],

            [
                'attribute'=>'price',
                'label'=>'ราคา',
                'value'=>function($model){
                    return $model->price." บาท";
                }
            ],

            [
                'attribute'=>'current_amount',
                'label'=>'จำนวน',
                'value'=>function($model){
                    return $model->current_amount." ชิ้น";
                }
            ],

            [
                'attribute'=>'img',
                'format'=>'html',
                'value'=>function($model){
                    return Html::img($model->img,['width' => '100px']);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
