<?php
namespace frontend\controllers;

use common\models\helper;
use common\models\Orders;
use common\models\Product;
use common\models\ProductSearch;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
     * @inheritdoc
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
     * Show products only for Actual Date
     * @return mixed
     */
    public function actionIndex()
    {
        $tizer = Product::find()
            ->joinWith('options0')
            ->joinWith('images')
            ->where(['options.show_in_teaser'=>1])
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->all();

        $weRecommend = Product::find()
            ->joinWith('options0')
            ->joinWith('images')
            ->where(['options.show_in_homepage'=>1])
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->all();

        /**$avtoCharter = Product::find()
                ->joinWith('options0')
                ->joinWith('images')
                ->where(['options.show_in_dash'=>1, 'type'=>'4' ])
                ->andWhere(['>=','actual_date',time()]) // show before actual_date
                ->all();

        $aviaCharter = Product::find()
            ->joinWith('options0')
            ->joinWith('images')
            ->where(['options.show_in_dash'=>1, 'type'=>'3' ])
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->all();*/

        //$this->layout = 'front';
        return $this->render('index',[
            'tizer' => $tizer,
            'weRecommend' => $weRecommend,
            /**'avtoCharter' => $avtoCharter,
            'aviaCharter' => $aviaCharter,*/
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Дякуємо Вам за звернення до нас. Ми відповімо вам як можна швидше.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Show product Detail page
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionShowProduct($id)
    {
        $model = Product::findOne($id);

        if (!$model){
            throw new HttpException(404 ,'Не знайдено');
        }

        return $this->render('ShowProduct',[
            'model' => $model
        ]);
    }

    /**
     * Tour by Country
     * @param null $countryId
     * @return string
     * @throws HttpException
     */
    public function actionByCountry($countryId=null){
        if ($countryId==null){
            throw new HttpException(404, 'Не знайдено');
        }
        $data = Product::find()
            ->where(['country' => $countryId])
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->andWhere(['type'=>helper::PRODUCT_TYPE_TOUR])
            ->filterWhere(['region1'=>Yii::$app->request->getQueryParam('region1')])
            ->andFilterWhere(['region2'=>Yii::$app->request->getQueryParam('region2')])
            ->andFilterWhere(['sub_type'=>Yii::$app->request->getQueryParam('sub_type')])
            ->orderBy('created_at','name')
            ->all();

        $model = Product::find()
            ->where(['country' => $countryId])
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->andWhere(['type'=>helper::PRODUCT_TYPE_TOUR])
            ->orderBy('name')
            ->all();

        return $this->render('ShowByCountry',[
            'data'=>$data,
            'model' => $model // for filter
        ]);
    }

    /**
     * Hotel of the day
     * @return string
     */
    public function actionBooking(){
        $data = Product::find()
            ->joinWith(['options0'])
            ->where(['>=','actual_date',time()]) // show before actual_date
            ->andWhere(['options.show_in_other'=>1]) // show booking
            ->orderBy('name')
            ->all();
            return $this->render('showByBooking', [
                'data' => $data,
            ]);
    }

    /**
     * Show list of Excursions
     * @return string
     */
    public function actionExcursions(){
        $data = Product::find()
            //->where(['country' => $countryId])
            ->Where(['>=','actual_date',time()]) // show before actual_date
            ->andWhere(['type'=>helper::PRODUCT_TYPE_EXCURSIONS])
            ->orderBy('name')
            ->all();

        return $this->render('Excursions',[
            'data'=>$data,
        ]);
    }

    /**
     * List of Cruises
     * @return string
     */
    public function actionCruises(){
        $data = Product::find()
            ->Where(['>=','actual_date',time()]) // show before actual_date
            ->andWhere(['type'=>helper::PRODUCT_TYPE_CRUISES])
            ->orderBy('name')
            ->all();

        return $this->render('Cruises',[
            'data'=>$data,
        ]);
    }

    /**
     * Static Page
     * @return string
     */
    public function actionAllCountries(){
        return $this->render('tourSelect');
    }

    /**
     * Static page
     * @param $countryCode
     * @throws \yii\web\NotFoundHttpException
     * @return string
     */
    public function actionTravelInfo($countryCode=null)
    {
        if (!preg_match("/^[a-zA-Z0-9]+$/", $countryCode) == 1) {
                // string only contain the a to z , A to Z, 0 to 9
            throw new \yii\web\NotFoundHttpException('Сторінка не знайдена !');
        }
        return $this->render('simplePage',[
            'page_name' => 'travel-info',
            'countryCode' => $countryCode,
        ]);
    }

    public function actionTourCalendar()
    {
        return $this->render('simplePage',[
            'page_name' => 'tour-calendar',
            'countryCode' => ''
        ]);
    }

    /**
     * Show List of charters depends on type
     * @param $type
     * @return string
     * @throws HttpException
     */
    public function actionCharters($type){
        $model = Product::find()
            ->joinWith('options0')
            ->joinWith('images')
            ->where(['type'=>$type ])
            ->andWhere(['>=','actual_date',time()]) // show before actual_date
            ->all();
        if ($model) {
            return $this->render('charter', [
                'model' => $model,
                'type'=>$type
            ]);
        } else {
            throw new HttpException(404 ,'Не знайдено');
        }
    }

    /**
     * Frontend Customers make an order for product
     * @param $id
     * @return \yii\web\Response
     */
    public function actionNewOrder($id){

        $model = new Orders();
        $model->selected_product = $id;
        $model->order_status = helper::ORDER_STATUS;
        $product = Product::findOne($id);

        $message = 'Обрана дата:';

        foreach ($product->applydates as $data){
            $message .= date('d.m.Y',$data->begin_date) . ' - '. date('d.m.Y',$data->end_date);
        }
        $model->message = $message;

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->save()){

                if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('info', 'Дякуємо за замовлення. Очікуйте дзвінка нашого менеджера.');
                }
                return $this->redirect(['site/show-product', 'id' => $product->id]);
            }
        } else {
            if ($model->hasErrors()) {
                Yii::$app->session->setFlash('error', json_encode($model->errors));
            }
        }

        return $this->render('orderForm',[
            'model' => $model,
            'product'=> $product
        ]);

    }
}
