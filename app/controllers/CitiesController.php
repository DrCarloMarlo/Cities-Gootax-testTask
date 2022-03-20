<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Cities;

class CitiesController extends Controller
{
    public function actionAll()
    {
        $api = new Cities();

        return $this->render('list-cities', ['resourceReviews' => $api->getAll()]);
    }
}