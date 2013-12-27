<?php

class Create_Categories_Table
{

    public function up()
    {
        Schema::table('categories', function($table) {
            $table->charset = 'utf8';
            $table->create();
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::drop('categories');
    }

}