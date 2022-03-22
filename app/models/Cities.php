<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cities extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id', 'date_create'], 'integer'],
            ['name', 'string', 'length' => [3, 60]],
        ];
    }

    public static function tableName()
    {
        return '{{cities}}';
    }

    public function getReviewsList()
    {
        return $this->hasMany(ReviewToCity::class, ['id_city' => 'id'])
            ->leftJoin('reviews', ['reviews.id' => 'review_cities_fk.id_review']);
    }

    public function getReview()
    {
        return $this->hasMany(Reviews::class, ['id' => 'id_review'])
            ->select('author.username as author_fio, title, text, rating, img, id_author')
            ->joinWith('author')
            ->orderBy('rating DESC')
            ->via('reviewsList');
    }

    public static function getAll()
    {
        return Cities::find()
            ->select(['{{cities}}.id, {{cities}}.name', 'COUNT({{review_cities_fk}}.id) as reviewsCount'])
            ->joinWith('reviewsList')
            ->groupBy('{{cities}}.id')
            ->orderBy('name ASC')
            ->all();
    }

    public static function getReviewByCity($name)
    {
        $result = Cities::find()
            ->where(['name' => $name])
            ->one();

        return $result === null ?  false : $result->review;
    }

    public static function getId($name)
    {
        $result = Cities::find()
            ->select('id')
            ->where(['name' => $name])
            ->one();

        return $result === null ? false : $result->id;
    }

    public static function checkExist($name)
    {
        $result = Cities::find()
            ->where(['name' => $name])
            ->exists();

        return $result;
    }

    public static function createNewRecord($name)
    {
        $city_record = new Cities;
        $city_record->name = $name;
        $city_record->date_create = time();

        return $city_record->save();
    }
}