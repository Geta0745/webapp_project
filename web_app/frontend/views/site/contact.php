<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;
$model->name = Yii::$app->user->identity->username;
$model->email = Yii::$app->user->identity->email;
$model->description = "...";
$this->title = 'Rate Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        ประเมินให้คะแนนความพึงพอใจของคุณกับเรา :)
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true,'readonly'=>true]) ?>

                <?= $form->field($model, 'email')->textInput(['readonly'=>true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= Html::activeDropDownList($model, 'rate',[''=>'--คะแนนความพึงพอใจ--',1=>'น้อยที่สุด',2=>'น้อย',3=>'ปานกลาง',4=>'มาก',5=>'มากที่สุด'],['class'=>'form-control']) ?><br>

                <div class="form-group">
                    <?= Html::submitButton('ส่งประเมิน', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
