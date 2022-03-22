<?php

namespace app\controllers;

use app\models\Session;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\Cities;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\Utill;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Utill();
        $session = new Session();
        $sessionNow = $session->openSession();

        if ($sessionNow->has('user_city')) {
            return $this->redirect("/reviews/city?name=".$sessionNow->get('user_city'));
        } else {
            $api_result= $model->getUserCity(Yii::$app->request->userIP);
            if ($api_result['status'] === 'fail') {
                return $this->redirect('/cities/all');
            } else {
                $cities = new Cities();
                $id_city = $cities->getId($api_result['city']);

                if ($id_city !== false) {
                    $session->setParamsSession('user_city', $api_result['city']);
                    $session->setParamsSession('id_city', $id_city);
                    return $this->render('index', ['city' => $api_result['city']]);
                } else {
                    return $this->redirect('/cities/all');
                }
            }
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), 'SignupForm') && $model->signup()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAuthorContacts() {
        return $this->renderPartial('modal_contacts');
    }
}
