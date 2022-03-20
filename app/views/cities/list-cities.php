<?php
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = "SelectCity||CitiesAPI";
?>

<div id='content-container' class="body-content" data-controller="none" data-action="none">
    <div class='row page-header'>
        <h1 id='page-title'>Выбор города</h1>
    </div>
    <div class='row' id='page-content'>
        <?php foreach ($resourceReviews as $resource): ?>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4" data-city="{{name}}">
                    <a href= <?= Url::toRoute(['/reviews/city', 'name' => $resource->name]);?> ><?= Html::encode($resource->name);?></a>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-4" data-city="{{name}}">
                    <p>Отзывов - <?= Html::encode($resource->reviewsCount);?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
