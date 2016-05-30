<?php
/**
 * Page Output View
 * @var $page_name
 */

use common\widgets\PageOutput;
use common\widgets\Charter;
use common\models\helper;
?>

<div class="col-sm-8">
    <?=PageOutput::widget([
        'page_name' => $page_name
    ])?>
</div>
<div class="col-sm-2">
    <!-- side widget-->
    <?=Charter::widget([
        'type' => helper::PRODUCT_TYPE_AVTO,
        'header' => 'Автобусні чартери'
    ])?>

    <?=Charter::widget([
        'type' => helper::PRODUCT_TYPE_AVIA,
        'header' => 'Авіа чартери'
    ])?>
    <!-- side widget-->
    <!-- weather widget -->

    <!-- weather widget -->
</div>