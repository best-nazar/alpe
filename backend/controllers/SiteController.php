<?php
namespace backend\controllers;

use backend\models\imageFactory;
use common\models\Images;
use common\models\Product;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','delete-photo', 'set-main-image'],
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
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
            $this->layout = 'login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @param $fileId - file_name in DB
     * @param $productId
     * @throws \Exception
     */
    public function actionDeletePhoto($fileId, $productId){
        $file = Yii::getAlias('@webroot'). '/images/'.$productId.'/'.$fileId;

        if (is_file($file)){
            if (unlink($file)){
                // delete from DB
                imageFactory::deleteImageFromDb($fileId,$productId);
            }
        } else {
            imageFactory::deleteImageFromDb($fileId,$productId);
        }
        $this->redirect(['product/view', 'id'=>$productId, '#'=>'w6-tab5']);
    }

    /**
     * Set main image for product
     * @param $fileId file_name in DB
     * @param $productId
     * @return null|static
     */
    public function actionSetMainImage($fileId, $productId)
    {
        $product = Product::findOne($productId);
        if ($product){
            $product->main_image = $fileId;
        }
        if ($product->save()){
            $this->redirect(['product/view', 'id'=>$productId, '#'=>'w6-tab5']);
        }
    }
}
