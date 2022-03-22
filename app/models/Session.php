<?php

namespace app\models;

use Yii;
use yii\web\CacheSession;

class Session
{
    function openSession()
    {
        $session = new CacheSession();

        $session->setCookieParams(['lifetime' => 2 * 60 * 60]);
        $session->setTimeout(2 * 60 * 60);
        $session->open();

        return $session;
    }

    function setParamsSession($paramName, $paramValue)
    {
        $session = Yii::$app->session;

        $session->set($paramName, $paramValue);
    }
}