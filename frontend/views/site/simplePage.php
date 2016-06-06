<?php
/**
 * Page Output View
 * @var $page_name
 */

use common\widgets\PageOutput;
use common\widgets\Charter;
use common\models\helper;
?>

<div class="col-sm-10">
    <?=PageOutput::widget([
        'page_name' => $page_name
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