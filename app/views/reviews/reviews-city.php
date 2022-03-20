<?php
use yii\bootstrap\Html;

$this->title = "Reviews||${city}||CitiesAPI";
?>

<div id='content-container' class="body-content" data-controller="reviews" data-action="run">
    <div class='row page-header'>
        <h1 id='page-title'>Отзывы - <?= $city;?></h1>
    </div>
    <div class='row'>
        <div class="left-pull">
            <a href='/cities/all'>Изменить город</a>
        </div>
        <?= $isAuth ?
            '<div class="right-pull"><a href="/reviews/create" class="btn btn-primary">Написать отзыв</a></div>':
            '<div></div>';?>
    </div>
    <div class='row' id='page-content'>
        <table id='content-table' class='table table-hover'>
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Отзыв</th>
                    <th>Рэйтинг</th>
                    <th>Изображение</th>
                    <th>Автор</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($resourceReviews as $resource): ?>
                <tr>
                    <td><?= Html::encode($resource->title);?></td>
                    <td><?= Html::encode($resource->text);?></td>
                    <td><?= Html::encode($resource->rating);?></td>
                    <td><?= $isAuth ? Html::submitButton($resource->author_fio, ['type'=> 'button', 'class' => 'submit contacts',
                            'data-author' => $resource->id_author, 'data-toggle' => 'modal', 'data-target' => '#contacts-modal']) :
                            Html::encode($resource->author_fio);?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="contacts-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel"></h4>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>