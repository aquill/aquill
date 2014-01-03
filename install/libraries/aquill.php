<?php

class Aquill
{
    public static $options = null;

    public static function setup()
    {
        static::$options = Session::get('install');

        static::drop();

        static::configs();

        static::tables();

        static::insert();

        static::$options = Session::forget('install');
    }

    public static function tables()
    {
        static::options();

        static::users();

        static::posts();

        static::terms();

        static::relationships();

        static::comments();
    }

    public  static function table_exists()
    {
        if (Schema::hasTable('options')) return true;
        
        if (Schema::hasTable('posts')) return true;
        
        if (Schema::hasTable('terms')) return true;
        
        if (Schema::hasTable('relationships')) return true;
        
        if (Schema::hasTable('comments')) return true;
        
        if (Schema::hasTable('users')) return true;

        return false;
    }

    public static function drop()
    {
        if (Schema::hasTable('options'))
            Schema::drop('options');

        if (Schema::hasTable('posts'))
            Schema::drop('posts');

        if (Schema::hasTable('terms'))
            Schema::drop('terms');

        if (Schema::hasTable('relationships'))
            Schema::drop('relationships');

        if (Schema::hasTable('comments'))
            Schema::drop('comments');

        if (Schema::hasTable('users'))
            Schema::drop('users');

        return true;
    }

    public static function options()
    {
        Schema::create('options', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->string('key');
            $table->string('value');
        });
    }

    public static function posts()
    {
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
        Schema::create('terms', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->enum('taxonomy', array('tag', 'category', 'link'));
            $table->text('description');
            $table->integer('parent');
            $table->integer('count');
        });
    }

    public static function relationships()
    {
        Schema::create('relationships', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->integer('post_id');
            $table->integer('term_id');
        });
    }

    public static function comments()
    {
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
            $table->enum('status', array('approved', 'pending', 'spam'));
            $table->string('agent');
            $table->integer('parent');
            $table->integer('uesr_id');
        });
    }

    public static function users()
    {
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
            $table->enum('role', array('administrator', 'editor', 'author', 'contributor', 'subscriber', 'pending'));
        });
    }

    public static function insert()
    {
        $data = Config::get('data');

        foreach ($data as $table => $row) {
            foreach ($row as $r) {
                if (!is_array($r)){
                    DB::table($table)->insert($row);
                    break;
                }
                DB::table($table)->insert($r);
            }
        }

        return true;
    }

    public static function configs()
    {
        $options = static::$options;

        if (is_null($options)) return;

        $config['app'] = Braces::compile(APP . 'storage/app.php', array(
                'url' => $options['metadata']['url'],
                'index' => $options['metadata']['index'],
                'key' => Str::random(32),
                'language' => $options['i18n']['language'],
                'timezone' => $options['i18n']['timezone'],
            ));

        $database = $options['database'];

        $config['database'] = Braces::compile(APP . 'storage/database.php', array(
                'driver' => $database['driver'],
                'host' => $database['host'],
                'port' => $database['port'],
                'username' => $database['username'],
                'password' => $database['password'],
                'database' => $database['database'],
                'charset' => $database['charset'],
                'prefix' => $database['prefix'],
            ));
/*
        $rewrites = $options['rewrites'];

        $config['rewrite'] = Braces::compile(APP . 'storage/rewrite.php', array(
                'home' => $rewrites['home'],
                'post' => $rewrites['post'],
                'page' => $rewrites['page'],
                'category' => $rewrites['category'],
                'tag' => $rewrites['tag'],
                'author' => $rewrites['author'],
            ));
*/
        $htaccess = file_get_contents(STORAGE . 'htaccess');

        try {
            file_put_contents(PATH . 'aquill/config/app.php', $config['app']);
            file_put_contents(PATH . 'aquill/config/database.php', $config['database']);
            //file_put_contents(PATH . 'aquill/config/rewrite.php', $config['rewrite']);
            file_put_contents(PATH . '.htaccess', $htaccess);
        } catch (Exception $e) {
            return $e->message();
        }

        return true;
    }

}