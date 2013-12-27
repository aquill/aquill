<?php

class Create_Posts_Meta_Table
{

    public function up()
    {
        Schema::table('posts_meta', function($table) {
            $table->charset = 'utf8';
            $table->create();
            $table->increments('id');
            $table->integer('post');
            $table->integer('extend');
            $table->text('data');
        });
    }

    public function down()
    {
        Schema::drop('posts_meta');
    }

}