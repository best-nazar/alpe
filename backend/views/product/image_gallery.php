<?php

/**
 * Show and Upload images
 * User: Naz
 * Date: 18.05.2016
 */

/* @var $model - common\models\Product */
/* @var $modelImages - common\models\Images */

use dosamigos\fileupload\FileUploadUI;?>

    <h3>Галерея фотографій</h3>
    <p>Розміри зображення : висота = <?=\common\models\helper::IMAGE_HEIGHT?>px, ширина = <?=\common\models\helper::IMAGE_WIDTH?>px . Перше завантажене фото стає головним</p>
    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<?php foreach ($modelImages as $image) {
    $filePath = '/images/'.$model->id.'/'.$image->file_name;
    ?>
    <hr/>
    <div class="row">
        <div class="col-xs-6 col-md-4"><img src="<?=$filePath?>" style="max-width: 300px; padding: 5px"/></div>
        <div class="col-xs-6 col-md-4"><?=$filePath?></div>
        <div class="col-xs-6 col-md-2">
            <?php if ($model->main_image == $image->file_name) { ?>
                <b>Головне зображення</b>
            <?php } else { ?>
                <?=\yii\bootstrap\Html::button('Зробити головним',['onClick'=>'setMainImage("'.$image->file_name.'",'.$model->id.' )'])?>
            <?php } ?>
        </div>
        <div class="col-xs-6 col-md-2"><?=\yii\bootstrap\Html::button('Знищити',['onClick'=>'deleteImage("'.$image->file_name.'",'.$model->id.' )'])?></div>
    </div>
<?php } ?>
<p>&nbsp;</p>
<?php echo FileUploadUI::widget([
    //'model' => $model,
    'name'=> 'files',
    'attribute' => 'main_image',
    'url' => ['product/image-upload', 'id' => $model->id],
    'gallery' => false,
    'fieldOptions' => [
        'accept' => 'image/*'
    ],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    // ...
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
        'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
    ],
]);

