<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = "CreateReviews||CitiesAPI";
?>
<div id='content-container' class="body-content" data-controller="none" data-action="none">
    <div class="createReview-page">
        <main>
            <div class="createReview-block">
                <h1>Создайте отзыв</h1>

                <?php $form = ActiveForm::begin([
                    'id' => 'review-create-form',
                    'layout' => 'horizontal',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'fieldConfig' => [
                        'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>"
                    ],
                ]); ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => "Заголовок"]) ?>
                <hr class="hr-xs">
                <?= $form->field($model, 'text')->textInput(['class' => 'form-control', 'placeholder' => "Отзыв"]) ?>
                <hr class="hr-xs">
                <?= $form->field($model, 'rating')->dropDownList([1=>1,2=>2,3=>3,4=>4,5=>5]) ?>
                <hr class="hr-xs">
                <?= $form->field($model, 'city')->dropDownList($city, ['multiple' => 'multiple']) ?>
                <hr class="hr-xs">
                <?= $form->field($model, 'imageFile')->fileInput() ?>

                <?= Html::submitButton('Создать', ['class' => 'btn btn-primary btn-block', 'name' => 'create-button']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </main>
    </div>
</div>
