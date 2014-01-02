<?php

class Create
{

    public static function all()
    {
        static::posts();
        static::terms();
        static::relationships();
        static::comments();
        static::users();
    }

    public static function posts()
    {
        if (Schema::hasTable('posts')) {
            Schema::drop('posts');
        }

        Schema::create('posts', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('author');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->text('excerpt');
            $table->enum('status', array('publish', 'draft', 'inherit'));
            $table->enum('type', array('post', 'page', 'revision', 'menu', 'attachment'));
            $table->string('password');
            $table->timestamps();
            $table->integer('parent');
            $table->string('guid');
            $table->string('mime');
            $table->integer('menu_order');
            $table->boolean('comment_status');
            $table->integer('comment_count');
        });
    }

    public static function terms()
    {
        if (Schema::hasTable('terms')) {
            Schema::drop('terms');
        }

        Schema::create('terms', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->enum('taxonomy', array('post_tag', 'category', 'link_category'));
            $table->text('description');
            $table->integer('parent');
            $table->integer('count');
        });
    }

    public static function relationships()
    {
        if (Schema::hasTable('relationships')) {
            Schema::drop('relationships');
        }

        Schema::create('relationships', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->integer('post_id');
            $table->integer('term_id');
        });

    }

    public static function comments()
    {
        if (Schema::hasTable('comments')) {
            Schema::drop('comments');
        }

        Schema::create('comments', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_id');
            $table->string('name');
            $table->string('email');
            $table->string('url');
            $table->string('ip');
            $table->date('created_at');
            $table->text('content');
            $table->integer('karma');
            $table->boolean('approved');
            $table->string('agent');
            $table->string('type');
            $table->integer('parent');
            $table->integer('uesr_id');
        });
    }

    public static function users()
    {
        if (Schema::hasTable('users')) {
            Schema::drop('users');
        }

        Schema::create('users', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('nicename');
            $table->string('email');
            $table->string('url');
            $table->date('registered');
            $table->string('activation_key');
            $table->boolean('status');
            $table->enum('role', array('administrator', 'editor', 'author', 'contributor', 'subscriber'));
        });
    }

}