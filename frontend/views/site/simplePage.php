<?php
/**
 * Page Output View
 * @var $page_name
 * @var $countryCode = null | string
 */

use common\widgets\PageOutput;
use common\widgets\Charter;
use common\models\helper;

$this->title = 'Інформація подорожуючому';
$this->params['breadcrumbs'][] = $this->title;
if ($countryCode) {
    $this->params['breadcrumbs'][] = helper::getCountryByCode( $countryCode )->name;
}
?>

<div class="col-sm-10">
    <?=PageOutput::widget([
        'page_name' => $page_name,
        'countryCode' => $countryCode
    ])?>
</div>
<!--<div class="col-sm-2">
    <?=Charter::widget([
        'type' => helper::PRODUCT_TYPE_AVTO,
        'header' => 'Автобусні чартери'
    ])?>

    <?=Charter::widget([
        'type' => helper::PRODUCT_TYPE_AVIA,
        'header' => 'Авіа чартери'
    ])?>
</div>-->