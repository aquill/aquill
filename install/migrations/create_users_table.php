<?php

class Create_Users_Table
{

    public function up()
    {
        Schema::table('users', function($table) {
            $table->charset = 'utf8';
            $table->create();
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('realname');
            $table->text('bio');
            $table->enum('status', array('inactive', 'active'));
            $table->enum('role', array('administrator', 'editor', 'user'));
            $table->date('created');
        });
    }

    public function down()
    {
        Schema::drop('users');
    }

}