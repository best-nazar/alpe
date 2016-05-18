<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%product}}',[
            'id' => $this->primaryKey(),
            'country' => $this->integer()->notNull()->comment('Країна'),
            'region1' => $this->string(128)->comment('Регіон 1*'),
            'region2' => $this->string(128)->comment('Регіон 2*'),
            'type'=> $this->integer()->notNull()->comment('Тип'), //тур, круїз, екскурсії.... FK Types Table
            'price' => $this->decimal()->defaultValue(0)->comment('Ціна'),
            'currency'=> $this->integer()->notNull()->comment('Валюта'), // FK Currency Table
            'actual_date' => $this->integer()->notNull()->comment('Актуальний до:'), //дата доки показувати тур на сайті
            //'apply_date'=>$this->integer()->notNull(), //  ApplyDates - дати коли тур актуальний One To Many
            'options' => $this->integer()->notNull(), //  FK, Show in Teaser,In Dash, etc options Table
            'name' => $this->string()->notNull()->comment('Назва'),
            'short_desc' => $this->string()->comment('Короткий опис'),
            'description' => $this->text()->comment('Повний опис'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Службове'),
            'teg'=> $this->integer()->notNull(), // Teg Id FK
            'main_image'=>$this->string(64),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%country}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('Назва'),
            'code' => $this->string(2)->notNull()->comment('Код країни'),
        ],$tableOptions);

        $this->createTable('{{%productOptions}}',[
            'id' => $this->primaryKey(),
            'product' =>$this->integer(), // FK to Product table
            'location' => $this->text()->comment('Місцезнаходження'),
            'stars' => $this->string(3)->notNull()->comment('К-сть зірок'),
            'in_hotel' => $this->text()->comment('В готелі'),
            'in_room' => $this->text()->comment('В номері'),
            'additional_services' => $this->text()->comment('Додаткові послуги'),
            'food' => $this->text()->comment('Харчування'),
            'beach' =>$this->text()->comment('Пляж'),
            'note' =>$this->text()->comment('Примітка'),
            'web' =>$this->text()->comment('Web-адреса'),
            //'' =>$this->text()->comment(''),
        ],$tableOptions);

        $this->createTable('{{%types}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
        ],$tableOptions);

        $this->createTable('{{%currency}}',[
            'id' => $this->primaryKey(),
            'label' => $this->string(64)->notNull()->comment('Назва'),
            'code' => $this->string(3)->notNull()->comment('Код'),
        ],$tableOptions);

        $this->createTable('{{%teg}}',[
            'id' => $this->primaryKey(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'meta_keywords' => $this->string()
        ],$tableOptions);

        $this->createTable('{{%options}}',[
            'id' => $this->primaryKey(),
            'show_in_teaser' => $this->smallInteger()->defaultValue(0)->comment('Показувати в Тізері'),
            'show_in_dash' => $this->smallInteger()->defaultValue(0)->comment('Показувати на панелі'),
            'show_in_homepage' => $this->smallInteger()->defaultValue(0)->comment('Виводити на головній сторінці'),
            'show_in_other' => $this->smallInteger()->defaultValue(0)->comment('Показувати у блоці'),
        ], $tableOptions);

        $this->createTable('{{%orders}}',[
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'customer_name' => $this->string()->notNull()->comment('Ім`я замовника'),
            'customer_phone' => $this->string(15)->notNull()->comment('Телефон'),
            'customer_email' => $this->string(128)->comment('e-mail'),
            'message' => $this->string()->comment('Повідомлення'),
            'selected_product'=> $this->integer()->notNull(),
            'order_status' => $this->smallInteger()->comment('Статус'),
        ],$tableOptions);

        $this->createTable('{{%orderStatus}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(128)
        ],$tableOptions);

        $this->createTable('{{%applyDates}}',[
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'begin_date' => $this->integer()->comment('Початок'),
            'end_date' => $this->integer()->comment('Кінець'),
        ],$tableOptions);

        $this->addForeignKey('country_fk','{{%product}}',['country'], '{{%country}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('type_fk','{{%product}}',['type'], '{{%types}}', ['id'], 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('currency_fk','{{%product}}',['currency'], '{{%currency}}', ['id'], 'RESTRICT', 'RESTRICT');

        /** When DELETE/UPDATE record at %product Table , then  DELETE/Update record at %applyDates */
        $this->addForeignKey('product_fk','{{%applyDates}}',['product_id'], '{{%product}}', ['id'], 'CASCADE', 'CASCADE');
        /** When DELETE/UPDATE record at %product Table, then DELETE/UPDATE record at %options Table */
        $this->addForeignKey('options_fk','{{%product}}',['options'], '{{%options}}', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('teg_fk','{{%product}}',['teg'], '{{%teg}}', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('opt_fk','{{%productOptions}}',['product'], '{{%product}}', ['id'], 'CASCADE', 'CASCADE');

        /** Batch Insert */
        $this->batchInsert ('country',
            ['name', 'code'],
            [
                ['Хорватія', 'HR' ],
                ['Албанія', 'AL' ],
                ['Греція', 'GR' ],
                ['Чорногорія', 'MN' ],
                ['Україна', 'UA' ]
            ]
        );
        $this->batchInsert ('types', //table
                ['name'],// column
            [
                ['Тур'], // row
                ['Круіз'],
                ['Авіачартер'],
                ['Автобусний чартер'],
                ['Екскурсії']
            ]
            );
        $this->batchInsert ('currency',
            ['label', 'code'],
            [
                ['Гривня', 'UAH'],
                ['Долар США', 'USD'],
                ['Євро', 'EUR']
            ]
        );
        $this->batchInsert ('orderStatus',
            ['name'],
            [
                ['Очікує'],
                ['Надано пропозицію'],
                ['Відмова'],
                ['Продано'],
                ['Закрито']
            ]
            );
    }

    public function down()
    {
        $this->dropForeignKey('country_fk','{{%product}}');
        $this->dropForeignKey('type_fk','{{%product}}');
        $this->dropForeignKey('currency_fk','{{%product}}');
        $this->dropForeignKey('product_fk','{{%applyDates}}');
        $this->dropForeignKey('options_fk','{{%product}}');
        $this->dropForeignKey('teg_fk','{{%product}}');
        $this->dropForeignKey('opt_fk','{{%productOptions}}');

        $this->dropTable('{{%user}}');
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%country}}');
        $this->dropTable('{{%types}}');
        $this->dropTable('{{%currency}}');
        $this->dropTable('{{%teg}}');
        $this->dropTable('{{%options}}');
        $this->dropTable('{{%orders}}');
        $this->dropTable('{{%orderStatus}}');
        $this->dropTable('{{%applyDates}}');
        $this->dropTable('{{%productOptions}}');
    }
}
