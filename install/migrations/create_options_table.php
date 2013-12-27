<?php

class Create_Options_Table
{

    public function up()
    {
        Schema::table('options', function($table) {
            $table->charset = 'utf8';
            $table->create();
            $table->string('key');
            $table->text('value');
        });
    }

    public function down()
    {
        Schema::drop('options');
    }

}