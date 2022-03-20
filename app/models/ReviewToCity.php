<?php

namespace app\models;

use yii\db\ActiveRecord;

class ReviewToCity extends ActiveRecord
{

    public function rules()
    {
        return [

        ];
    }
    public static function tableName()
    {
        return '{{reviews_cities}}';
    }
}