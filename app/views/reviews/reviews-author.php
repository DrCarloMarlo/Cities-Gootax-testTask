<?php
use yii\bootstrap\Html;

$this->title = "Reviews||${author_fio}||CitiesAPI";
?>

<div id='content-container' class="body-content" data-controller="reviews" data-action="run">
    <div class='row page-header'>
        <h1 id='page-title'>Автор - <?= $author_fio;?></h1>
    </div>
    <div class='row'>
        <div class="left-pull">
            <a href='/cities/all'>Вернуться</a>
        </div>
    </div>
    <div class='row' id='page-content'>
        <table id='content-table' class='table table-hover'>
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Отзыв</th>
                    <th>Рэйтинг</th>
                    <th>Город</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($resourceReviews as $resource): ?>
                <tr>
                    <td><?= Html::encode($resource['title']);?></td>
                    <td><?= Html::encode($resource['text']);?></td>
                    <td><?= Html::encode($resource['rating']);?></td>
                    <td>
                        <?php foreach ($resource['cities'] as $city): ?>
                            <?= Html::encode($city['name']);?>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>