<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Вход';
?>
<div class="login-page">
    <main>
        <div class="login-block">
            <h1>Войдите в свой аккаунт</h1>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>"
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => "Ваш email"]) ?>
            <hr class="hr-xs">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => "Ваш Пароль"]) ?>

            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="login-links">
            <p class="text-center">У Вас нет аккаунта? <a class="txt-brand" href="../site/signup">Регистрация</a></p>
        </div>
    </main>
</div>