<?php
$this->title = 'Greetings||CitiesAPI';
?>

<div id='content-container' class="body-content" data-controller="none" data-action="main">
    <div class='page-header'>
        <h1 id='page-title'>Привет!</h1>
    </div>
    <div id='page-content'>
        <div class="row">
            <span>Ваш город? <?= $city;?></span><span><a href=<?= "/reviews/city?name=" . $city;?>>Да</a>
        <span>/</span><span></span><a href='/cities/all'>Изменить</a></span>
        </div>
    </div>
</div>