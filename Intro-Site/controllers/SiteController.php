<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\UserForm;
use yii\web\NotFoundHttpException;
use app\models\User;
use yii\web\UploadedFile;
use \yii\helpers\Url;

class SiteController extends Controller
{
    public function behaviors() 
    {
        return [
            'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                    [
                    'actions' => ['login','index','register', 'error'],
                    'allow' => true,
                    ],
                    [
                        
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin() {
        $this->layout='simple';
       
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRegister()
    {
        $this->layout='simple';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goBack();
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    // public function actionUpdate()
    // {
    //     $model = User:: findIdentity(Yii::$app->user->identity->id);
    //    // $model = Posts::findOne(['id'=>$id,'posted_by'=>$user_id]);
    // //    var_dump($model);
    // //    die();
    //     if($model->load(Yii::$app->request->post())){
    //         // $model->posted_by = Yii::$app->user->identity->getId();
    //         var_dump($model);
    //         die();
    //         if($model->save(false)){
    //             return $this->redirect(['profile']);
    //         }
    //     }
    //     return $this->render('update',['model'=>$model]);
    // }

    public function actionUpdate()
    {
        $id = Yii::$app->user->id;
        $model = Userform::findModel($id);

        if ($model->load(Yii::$app->request->post())){
            if(UploadedFile::getInstance($model,'filename')!=null ){
                $name = UploadedFile::getInstance($model,'filename');
                $path='images/'.$model->username.'.'.$name->extension;
                if($name->saveAs($path)){
                    $model->filename = $model->username.'.'.$name->extension;
                    $model->filepath= $path;
                }
            }
            
            $model-> update_user();
            Yii::$app->session->setFlash('success', Yii::t('app', 'Successful update!'));            
            return $this->redirect(['profile']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    function _maybe_create_upload_path($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755);
            fopen(rtrim($path, '/') . '/' . 'index.html', 'w');
        }
    }
}