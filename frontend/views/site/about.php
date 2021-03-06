<?php

/* @var $this yii\web\View */

use common\widgets\Charter;
use common\widgets\PageOutput;
use common\models\helper;

$this->title = 'Про нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-8">

    <p><?=PageOutput::widget([
            'page_name'=>'about'
        ])?></p>

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
