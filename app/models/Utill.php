<?php
/**
 * Created by PhpStorm.
 * User: carly
 * Date: 12.03.2022
 * Time: 13:39
 */

namespace app\models;

class Utill
{
    function getUserCity ($user_ip)
    {
        $ch = curl_init('http://ip-api.com/json/' . $_SERVER['REMOTE_ADDR'] . '?lang=ru');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);
        return $result;
    }
}