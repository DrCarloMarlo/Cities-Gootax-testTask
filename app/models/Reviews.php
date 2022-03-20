<?php

namespace app\models;

use yii\db\ActiveRecord;

class Reviews extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['rating', 'number', 'min' => 1, 'max' => 5],
            ['title', 'string', 'length' => [0, 100]],
            ['text', 'string', 'length' => [0, 255]],
        ];
    }
    public static function tableName()
    {
        return '{{reviews}}';
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }

    public function getCitiesList()
    {
        return $this->hasMany(ReviewToCity::class, ['id_review' => 'id'])
            ->leftJoin('cities', ['cities.id' => 'reviews_cities.id_city']);
    }

    public function getReviewsCity()
    {
        return $this->hasMany(Cities::class, ['id' => 'id_city'])
            ->select('cities.name')
            ->via('citiesList');
    }

    public function getAuthorAll($author)
    {
        $results = Reviews::find()
            ->select('reviews.id, reviews.title, reviews.text, reviews.rating')
            ->where(['id_author' => $author])
            ->all();

        $reviews = [];
        foreach ($results as $key => $result) {
            $reviews[$key]['id'] = $result['id'];
            $reviews[$key]['title'] = $result['title'];
            $reviews[$key]['text'] = $result['text'];
            $reviews[$key]['rating'] = $result['rating'];
            $reviews[$key]['cities'] = $result->reviewsCity;
        }
        return $reviews;
    }
}