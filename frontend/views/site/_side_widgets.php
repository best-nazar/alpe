<?php
/**
 * Right panel widgets
 */

use common\widgets\Charter;
use common\models\helper;

?>
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