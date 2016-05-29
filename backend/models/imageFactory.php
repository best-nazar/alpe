<?php
/**
 * Image manipulations
 */

namespace backend\models;

use Yii;
use common\models\helper;
use common\models\Images;

class imageFactory extends \yii\imagine\Image
{
    public static function resizeImage($fileName)
    {
        $file = Yii::getAlias('@webroot').$fileName;
        $img = self::thumbnail($file, helper::IMAGE_WIDTH, helper::IMAGE_HEIGHT);
        $img->save($file);
    }

    /**
     * Delete Image From DB
     * @param $fileId - file name in DB
     * @param $productId
     * @return false|int
     * @throws \Exception
     */
    public static function deleteImageFromDb($fileId, $productId)
    {
        $file = Yii::getAlias('@webroot'). '/images/'.$productId.'/'.$fileId;
        // delete from DB
        $img = Images::find()
            ->where(['file_name' => $fileId])
            ->one();
        return $img->delete();
    }
}