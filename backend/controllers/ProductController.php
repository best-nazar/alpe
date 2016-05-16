<?php

namespace backend\controllers;

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
            //var_dump($product);
            //var_dump($productOptions);
            //var_dump(Yii::$app->request->getBodyParam('actual_date'));
            $product->actual_date = strtotime(Yii::$app->request->getBodyParam('actual_date'));
                if ($teg->save(false)) {
                    $tegId = $teg->id;
                        //$productOptionsId = $productOptions->id;
                        if ($options->save(false)) {
                            $product->options = $options->id;
                            $product->teg = $tegId;
                        }
                }

            if ($product->save()) {
                $productOptions->product = $product->id;
                $productOptions->save();
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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

                $this->addImage($id, $fileName); //save image to DB

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
