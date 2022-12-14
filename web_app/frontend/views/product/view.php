<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
