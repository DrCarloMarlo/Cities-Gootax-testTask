<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ReviewCreateForm extends Model
{
    public $title;
    public $text;
    public $rating;
    public $city;
    public $img;

    /**
     * @var UploadedFile
     */
    public $imageFile;

    private $nameFile;

    public function rules()
    {
        return [
            [['title', 'text'], 'required', 'message' => 'Поле обязательно к заполнению'],
            [['title', 'text'], 'trim'],
            ['rating', 'number', 'min' => 1, 'max' => 5],
            ['title', 'string', 'length' => [0, 100]],
            ['text', 'string', 'length' => [0, 255]],
            ['city', 'required'],
            ['imageFile', 'file']
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $review = new Reviews();
        $review->title = $this->title;
        $review->text = $this->text;
        $review->rating = $this->rating;

        $review->id_author = Yii::$app->user->identity->id;
        $review->date_create = time();

        $status = $review->save() ? true : false;

        if ($this->imageFile !== null) {
            $review->img = $this->constructName();
            $review->save();

            $this->imageFile->saveAs($_SERVER["DOCUMENT_ROOT"] . '/uploads/' . $review->img);
        }

        if ($status) {
            if ($this->imageFile !== null)

            foreach ($this->city as $city) {
                $reviewRelation = new ReviewToCity();
                $reviewRelation->id_city = $city;
                $reviewRelation->id_review = $review->id;

                $reviewRelation->save();
            }
            return true;
        }
        return false;
    }

    private function constructName() {
        return uniqid()  . '.' . $this->imageFile->extension;
    }
}
