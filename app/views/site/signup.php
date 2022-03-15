<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;

$this->title = 'Registration';

?>
<div class="login-page">
    <main>
        <div class="login-block">
            <h1>Создайте свой аккаунт</h1>

            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>"
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => "Ваш email адрес"]) ?>
            <hr class="hr-xs">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => "Создайте пароль"]) ?>
            <?= $form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control', 'placeholder' => "Повторите пароль"]) ?>
            <hr class="hr-xs">
            <?= $form->field($model, 'phone')->textInput(['class' => 'form-control', 'placeholder' => "Ваш телефон"]) ?>
            <hr class="hr-xs">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => "Ваше Имя"]) ?>
            <hr class="hr-xs">
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className()) ?>
            <hr class="hr-xs">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="login-links">
            <p class="text-center">Уже есть аккаунт? <a class="txt-brand" href="../site/login">Войдите</a></p>
        </div>
    </main>
</div>