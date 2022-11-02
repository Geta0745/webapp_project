<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use frontend\models\Contact;
/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$query = Contact::find();
$this->title = 'คะแนนประเมิน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?=Html::encode($this->title)?></h1><hr>

    <?=GridView::widget([
    'dataProvider' => $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]),
    'columns' => [
        'name',
        'email',
        'description',
        'rate',
    ],
]);?>


</div>
