<?php

namespace backend\controllers;

use backend\models\imageFactory;
use common\models\Applydates;
use common\models\Country;
use common\models\Currency;
use common\models\Images;
use common\models\Options;
use common\models\Productoptions;
use common\models\Teg;
use common\models\Types;
use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use  yii\web\UploadedFile;
use yii\base\Model;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelImages' => Images::find()->where(['product'=>$id])->all(),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws ErrorException
     * @return mixed
     */
    public function actionCreate()
    {
        $product = new Product();
        $productOptions = new Productoptions();
        $teg = new Teg();
        $options = new Options();
        $applyDates = new Applydates();

        $countries = Country::find()
            ->addSelect(['id','name'])
            ->orderBy('name')
            ->asArray()
            ->all();
        $countriesMap = ArrayHelper::map($countries, 'id', 'name'); // (where 'id' becomes the value and 'name' the name of the value which will be displayed)

        $types = Types::find()
            ->orderBy('name')
            ->asArray()
            ->all();
        $typesMap = ArrayHelper::map($types, 'id', 'name');

        $currency = Currency::find()
            ->orderBy('code')
            ->asArray()
            ->all();
        $currencyMap = ArrayHelper::map($currency, 'id', 'code');


        if ( $product->load(Yii::$app->request->post())  &&
            $productOptions->load(Yii::$app->request->post())  &&
            $teg->load(Yii::$app->request->post())  &&
            $options->load(Yii::$app->request->post())
            ) {

            $product->actual_date = strtotime(Yii::$app->request->getBodyParam('actual_date'));
                if ($teg->save()) {
                    $tegId = $teg->id;
                        //$productOptionsId = $productOptions->id;
                        if ($options->save()) {
                            $product->options = $options->id;
                            $product->teg = $tegId;
                        }
                }

            if ($product->save()) {
                $productOptions->product = $product->id;
                $productOptions->save();

                // saving Apply dates
                foreach (Yii::$app->request->getBodyParam('applyDates') as $dates) {
                    $applyDates = new Applydates();
                    $applyDates->product_id = $product->id;
                    $applyDates->begin_date = strtotime ($dates['begin_date']);
                    $applyDates->end_date = strtotime ($dates['end_date']);
                    $applyDates->price = $dates['price'];
                    $applyDates->save();
                }

                return $this->redirect(['view', 'id' => $product->id]);

            } else {
                throw new ErrorException (Json::encode($product->errors));
            }

        } else {
            return $this->render('create', [
                'product' => $product,
                'countries' => $countriesMap,
                'types' => $typesMap,
                'currency' => $currencyMap,
                'productOptions' => $productOptions,
                'teg' => $teg,
                'options' => $options,
                'applyDates' => ArrayHelper::map($applyDates, 'begin_date', 'end_date')
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $errors = [];
        $product = $this->findModel($id);
        $productOptions = Productoptions::find()
            ->where(['product'=>$id])
            ->one();

        $countries = Country::find()
            ->addSelect(['id','name'])
            ->orderBy('name')
            ->asArray()
            ->all();
        $types = Types::find()
            ->orderBy('name')
            ->asArray()
            ->all();
        $currency = Currency::find()
            ->orderBy('code')
            ->asArray()
            ->all();
        $applyDates = Applydates::find()
            ->where(['product_id' => $id])
            ->orderBy('id')
            ->all();
        $currencyMap = ArrayHelper::map($currency, 'id', 'code');
        $countriesMap = ArrayHelper::map($countries, 'id', 'name'); // (where 'id' becomes the value and 'name' the name of the value which will be displayed)
        $typesMap = ArrayHelper::map($types, 'id', 'name');

        if (
                $product->load(Yii::$app->request->post())  &&
                $product->teg0->load(Yii::$app->request->post()) &&
                $product->options0->load(Yii::$app->request->post()) &&
                $productOptions->load( Yii::$app->request->post()) &&
                Model::loadMultiple($applyDates,Yii::$app->request->post(),'applyDates')
            ){

            if ($product->validate()){
                if (!$product->save()) $errors[]=$product->errors;

                if (Applydates::deleteAll('product_id ='. $id)) {
                    // saving Apply dates
                    foreach (Yii::$app->request->getBodyParam('applyDates') as $dates) {
                        $applyDate = new Applydates();
                        $applyDate->product_id = $product->id;
                        $applyDate->begin_date = strtotime($dates['begin_date']);
                        $applyDate->end_date = strtotime($dates['end_date']);
                        $applyDate->price = $dates['price'];

                        if (!$applyDate->save()) $errors[] =$applyDates->errors;
                    }
                }
            }
            if ($product->teg0->validate()) {
                if (!$product->teg0->save()) $errors[] = $product->errors;
            }
            if ($product->options0->validate()) {
                if (!$product->options0->save()) $errors[] = $product->errors;
            }
            if ($productOptions->validate()) {
                if (!$productOptions->save()) $errors[] = $productOptions->errors;
            }
            return $this->redirect(['view', 'id' => $product->id]);
        } else {
            return $this->render('update', [
                'product' => $product,
                'countries' => $countriesMap,
                'types' => $typesMap,
                'currency' => $currencyMap,
                'applyDates' => $applyDates
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImageUpload($id = null)
    {
        if ($id) {
            // setting productId for ImageDelete Action
            Yii::$app->session->set('productId', $id);
        }
        $imageFile = UploadedFile::getInstanceByName('files');
        //Yii::info($imageFile, 'test');

        $directory = $this->getUploadDir($id);
        //Yii::info('id='.$id, 'test');
        if (!is_dir($directory)) {
            mkdir($directory);
            Yii::info('Dir='.$directory, 'test');
        }
        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath)) {
                //$path = Url::to($filePath );
                $path = '/images/'.$id.'/'. $fileName;

                // resize image
                imageFactory::resizeImage($path);

                $this->addImage($id, $fileName); //save image to DB

                // set as main image first uploaded
                $productModel = Product::findOne($id);
                if ($productModel->main_image == '') {
                    $productModel->main_image = $fileName;
                    $productModel->save();
                }

                return Json::encode([
                    'files' => [[
                        'name' => $fileName,
                        'size' => $imageFile->size,
                        "url" => $path,
                        "thumbnailUrl" => $path,
                        "deleteUrl" => 'image-delete?name=' . $fileName,
                        "deleteType" => "POST"
                    ]]
                ]);
            }
        }
        return '';
    }

    public function actionImageDelete($name)
    {
        $id = Yii::$app->session->get('productId'); // Session was set in UploadImage Action

       // Yii::info('la-la = '.$name, 'test');
        $directory = $this->getUploadDir( $id );
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
            $this->removeImage($name);// remove image from DB
        }
        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file){
            $path = $path = '/images/'.$id.'/'. basename($file);
            $output['files'][] = [
                'name' => basename($file),
                'size' => filesize($file),
                "url" => $path,
                "thumbnailUrl" => $path,
                "deleteUrl" => 'image-delete?name=' . basename($file),
                "deleteType" => "POST"
            ];
        }
        return Json::encode($output);
    }

    /**
     * SetUp directory for Pictures Uploading
     * Create Symlink from "backecnd/web/images" to fronrend/web/images folder First !!
     *
     * @param $product_id
     * @return string
     */
    protected function getUploadDir($product_id){
        return \Yii::getAlias('@frontend') . DIRECTORY_SEPARATOR .'web'.DIRECTORY_SEPARATOR.'images'. DIRECTORY_SEPARATOR .$product_id.DIRECTORY_SEPARATOR ;
    }

    /**
     * Add image to database
     *
     * @param $id
     * @param $filename
     * @return bool
     */
    protected function addImage($id, $filename){
        $imageModel = new Images();
        $imageModel->product = $id;
        $imageModel->file_name = $filename;
        return $imageModel->save();
    }

    /**
     * Delete image from DB
     *
     * @param $name
     * @return int
     */
    protected function removeImage($name){
        return Images::deleteAll('file_name = :name ', [':name' => $name]);
    }
}
