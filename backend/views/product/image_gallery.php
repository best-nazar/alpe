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
    <p>Перше завантажене фото стає головним</p>
    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<?php foreach ($modelImages as $image) { ?>
    <div class="row">
        <div class="col-xs-6 col-md-4"><img src="/images/<?=$model->id?>/<?=($image->file_name)?>"/></div>
        <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
        <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
    </div>
<?php } ?>

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

