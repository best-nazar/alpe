<?php

use yii\db\Migration;

class m160618_200412_apply_dates extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->addColumn('{{%applyDates}}','place_type','string(10)');
    }

    public function down()
    {
        $this->dropColumn('{{%applyDates}}','place_type');
    }
}
