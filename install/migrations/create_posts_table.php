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
        Schema::table('posts', function($table) {
            $table->charset = 'utf8';
            $table->create();
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
            $table->integer('comment_status');
            $table->integer('comment_count');
        });

CREATE TABLE IF NOT EXISTS `aquill_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `excerpt` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'publish',
  `password` varchar(20) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'post',
  `mime` varchar(100) NOT NULL DEFAULT '',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `type_status_created` (`type`,`status`,`created`,`id`),
  KEY `parent` (`parent`),
  KEY `author` (`author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;