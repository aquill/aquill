<?php

class Create_Comments_Table
{

    public function up()
    {
        Schema::table('comments', function($table) {
            $table->charset = 'utf8';
            $table->create();
            $table->increments('id');
            $table->integer('post');
            $table->enum('status', array('pending', 'approved', 'spam'));
            $table->date('date');
            $table->string('name');
            $table->string('email');
            $table->string('url');
            $table->text('text');
            $table->integer('parent');
        });
    }

    public function down()
    {
        Schema::drop('comments');
    }

}