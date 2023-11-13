<?php

namespace app\controllers;

use app\models\Age;
use app\models\Comment;
use app\models\Proposal;
use app\models\SignupForm;
use app\models\Society;
use app\models\Timelist;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'account'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
        if (isset($_GET['id']) && $_GET['id'] != "")
        {
            $age = Age::find()->where(['id'=>$_GET['id']])->asArray()->one();
            $societies = Society::find()->where(['age_id'=>$_GET['id']])->all();
            $query = Society::find()->orderBy('date asc');
            $count = clone $query;
            $pages = new Pagination(['totalCount' => $count->count(), 'pageSize'=>1]);


            return $this->render('index', ['societies'=> $societies, 'age'=>$age, 'pages'=>$pages]);

        } else {
            $age = Age::find()->all();
            $query = Society::find()->orderBy('date asc');
            $count = clone $query;
            $pages = new Pagination(['totalCount' => $count->count(), 'pageSize'=>3]);
            $societies = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', ['societies'=> $societies, 'age'=>$age, 'pages'=>$pages]);
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
            if (Yii::$app->user->identity->isAdmin())
            {
                return $this->redirect(['/admin']);
            } else {
                return $this->redirect(['/site/account']);
            }
        }

        $model->password = '';
        return $this->render('login', [
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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProposal()
    {
        $model = new Proposal();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success', 'Заявка отправлена на рассмотрение');
                return $this->refresh();
            }
        }

        return $this->render('proposal', ['model'=>$model]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($user = $model -> signupSave())
            {
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionSocietyinfo($id)
    {
        $society = Society::find()->where(['id'=>$_GET['id']])->asArray()->one();
        $comments = Comment::find()->where(['soc_id'=>$_GET['id']])->all();
        $timelists = Timelist::find()->where(['society_id'=>$_GET['id']])->all();

        $model = new Comment();

        if ($model -> load(Yii::$app->request->post()) && $model->save())
        {
            return $this ->refresh();
        }

        return $this->render('societyinfo', compact('society', 'comments', 'model', 'timelists'));
    }

    public function actionAccount()
    {
        $user_proposals = Proposal::find()->where(['user_id'=>Yii::$app->user->getId()])->all();

        return $this->render('account', compact('user_proposals'));
    }

    public function actionTimelist()
    {
        $timelists = Timelist::find()->all();
        return $this->render('timelist', compact('timelists'));
    }
}
