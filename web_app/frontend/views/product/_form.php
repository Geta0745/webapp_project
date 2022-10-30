<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true])->label('ชื่อสินค้า') ?>

    <?= $form->field($model, 'product_description')->textInput(['maxlength' => true])->label('รายละเอียด') ?>

    <?= $form->field($model, 'price')->textInput()->label('ราคา') ?>

    <?= $form->field($model, 'current_amount')->textInput()->label('จำนวน') ?>
    <br>
    <?= $form->field($model, 'img')->fileInput()->label(false) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
