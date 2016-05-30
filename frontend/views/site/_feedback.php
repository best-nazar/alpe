<?php
/**
 * contact feedback view
 */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-lg-8">
        <p>
            Якщо у вас є ділова пропозиція або інші питання, будь ласка, заповніть наступну форму, щоб зв`язатися з нами. Дякуємо.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Ім`я') ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'subject')->label('Тема повідомлення') ?>

        <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('Текст повідомлення') ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Надіслати', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>