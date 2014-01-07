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
            $table->string('name');
            $table->string('value');
            $table->primary(array('name', 'value'));
        });
    }

    public static function posts()
    {
        Schema::create('posts', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('author')->default(1);
            $table->string('title');
            $table->string('slug')->default('');
            $table->text('content');
            $table->text('excerpt')->default('');
            $table->enum('status', array('publish', 'draft', 'inherit'))->default('publish');
            $table->enum('type', array('post', 'page', 'revision', 'menu', 'attachment'))->default('post');
            $table->string('password')->default('');
            $table->timestamps();
            $table->integer('parent')->default(0);
            $table->string('uri')->default('');
            $table->string('mime')->default('');
            $table->integer('menu_order')->default(0);
            $table->boolean('comment_status')->default(1);
            $table->integer('comment_count')->default(0);
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
            $table->text('description')->default('');
            $table->integer('parent')->default(0);
            $table->integer('count')->default(0);
        });
    }

    public static function relationships()
    {
        Schema::create('relationships', function ($table) {
            $table->charset = 'utf8';
            $table->engine = 'InnoDB';
            $table->integer('post_id');
            $table->integer('term_id');
            $table->primary(array('post_id', 'term_id'));
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
            $table->string('url')->default('');
            $table->string('ip')->default('');
            $table->date('created_at');
            $table->text('content');
            $table->integer('karma')->default(0);
            $table->enum('status', array('approved', 'pending', 'spam'))->default('pending');
            $table->string('agent')->default('');
            $table->integer('parent')->default(0);
            $table->integer('uesr_id')->default(0);
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
            $table->string('url')->default('');
            $table->text('bio');
            $table->date('registered');
            $table->string('activation_key')->default('');
            $table->enum('role', array('administrator', 'editor', 'author', 'contributor', 'subscriber', 'pending'))->default('pending');
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