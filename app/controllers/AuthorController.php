<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;

class AuthorController extends Controller
{
    public function actionContacts()
    {
        $api = new Author();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) return false;

        $get = Yii::$app->request->get();

        if (isset($get['author_id'])) {
            return $api->getContacts($get['author_id']);
        }
    }
}