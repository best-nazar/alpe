<?php
/**
 * Select tour view
 */
$this->title = 'Підбір туру по країнам';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$src="http://tangotravel.com.ua/start/?r=Y";
//if ($lang=="rus") $src="http://tangotravel.com.ua/ru/start/?r=Y";
?>
<div class="col-sm-10">
    <iframe name="" src="<?php echo $src;?>" frameborder="0" style="width:100%;min-height:800px;height:100%;" vspace="0" hspace="0"></iframe>
</div><!-- col -->
