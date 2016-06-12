<?php
/**
 * Excursions list
 * Tangotravel
 */


use frontend\assets\HomePageAsset;

HomePageAsset::register($this);

$this->title = 'Підбір туру по країнам / Екскурсійні тури';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-10">

    <?php
    $src="http://tangotravel.com.ua/start/?r=Y";
    //if ($lang=="rus") $src="http://tangotravel.com.ua/ru/start/?r=Y";
    ?>

        <iframe name="" src="<?php echo $src;?>" frameborder="0" style="width:100%;min-height:800px;height:100%;" vspace="0" hspace="0"></iframe>

</div>