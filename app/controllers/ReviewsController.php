<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

use app\models\Reviews;
use app\models\Cities;
use app\models\Author;
use app\models\ReviewCreateForm;

class ReviewsController extends Controller
{
    public function actionCity()
    {
        $apiCities = new Cities();

        $get = Yii::$app->request->get();

        if ($apiCities->checkExist($get['name']) && $apiCities->load($get, "")) {
            return $this->render('reviews-city', ['id_city' => $apiCities->getId($get['name']),
                'city' => $get['name'], 'resourceReviews' => $apiCities->getReviewByCity($get['name']), 'isAuth' => !Yii::$app->user->isGuest]);
        } else {
            return $this->goBack();
        }
    }

    public function actionAuthor()
    {
        if (Yii::$app->user->isGuest) return false;

        $apiReviews = new Reviews();
        $apiAuthor = new Author();
        $get = Yii::$app->request->get();

        if (isset($get['author_id'])) {
            return $this->render('reviews-author', ['author_fio' => $apiAuthor->getUsername($get['author_id']),
                'resourceReviews' => $apiReviews->getAuthorAll($get['author_id']), 'isAuth' => !Yii::$app->user->isGuest]);
        } else {
            return $this->goBack();
        }
    }

    public function actionCreate()
    {
        $model = new ReviewCreateForm();
        if ($model->load(Yii::$app->request->post(), 'ReviewCreateForm'))
        {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->create()) return $this->redirect(Yii::$app->homeUrl);
        }

        $cities = new Cities();
        $citiesObj = $cities->getAll();

        $list = ArrayHelper::map($citiesObj, 'id', 'name');
        return $this->render('form_create', [
            'city' => $list,
            'model' => $model,
        ]);
    }
}