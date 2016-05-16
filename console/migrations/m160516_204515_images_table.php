<?php
/**
 *  This will create Images table for storing list of images file names for product by Product id
 */
use yii\db\Migration;

class m160516_204515_images_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%images}}',[
            'id' => $this->primaryKey(),
            'product' =>$this->integer(), // FK to Product table
            'file_name' => $this->string(64)
        ], $tableOptions);

        /** When DELETE/UPDATE record at %product Table , then  DELETE/Update record at %images*/
        $this->addForeignKey('img_fk','{{%images}}',['product'], '{{%product}}', ['id'], 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('img_fk','{{%images}}');
        $this->dropTable('{{%images}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
