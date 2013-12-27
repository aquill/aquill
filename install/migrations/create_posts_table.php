<?php

class Create_Posts_Table
{

    public function up()
    {
        Schema::table('posts', function($table) {
            $table->charset = 'utf8';
            $table->create();
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('html');
            $table->timestamps();
            $table->integer('author');
            $table->integer('category');
            $table->enum('status', array('publish', 'draft'));
            $table->integer('comments');
        });
    }

    public function down()
    {
        Schema::drop('posts');
    }

}