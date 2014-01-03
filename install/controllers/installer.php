<?php

class InstallerController extends Controller
{
    public $restful = true;

    public function __construct()
    {
        if ($database = Session::get('install.database')) {
            Config::set('database.default', $database['driver']);
            Config::set('database.connections.' . $database['driver'], $database);
        }
    }

    public function getStart()
    {
        $vars['messages'] = Notify::read();
        $vars['languages'] = languages();
        $vars['timezones'] = timezones();

        return View::make('welcome', $vars);
    }

    public function postLanguage()
    {
        Session::put('current.language', Input::get('language', 'en'));

        return Redirect::to('start');
    }

    public function postStart()
    {
        $i18n = Input::only(array('language', 'timezone'));
        $rules = array(
            'language' => 'required',
            'timezone' => 'required'
        );

        $validation = Validator::make($i18n, $rules);

        if ($validation->invalid()) {
            Notify::error(_t('install.language_error'));
            return Redirect::to('start');
        }

        Session::put('current.language', Input::get('language', 'en'));
        Session::put('install.i18n', $i18n);

        return Redirect::to('database');
    }

    public function getDatabase()
    {
        if (!Session::get('install.i18n')) {
            Notify::error('Please select a language');
            return Redirect::to('start');
        }

        $vars['messages'] = Notify::read();

        $vars['collations'] = array(
            'utf8_bin' => 'Unicode (multilingual), Binary',
            'utf8_czech_ci' => 'Czech, case-insensitive',
            'utf8_danish_ci' => 'Danish, case-insensitive',
            'utf8_esperanto_ci' => 'Esperanto, case-insensitive',
            'utf8_estonian_ci' => 'Estonian, case-insensitive',
            'utf8_general_ci' => 'Unicode (multilingual), case-insensitive',
            'utf8_hungarian_ci' => 'Hungarian, case-insensitive',
            'utf8_icelandic_ci' => 'Icelandic, case-insensitive',
            'utf8_latvian_ci' => 'Latvian, case-insensitive',
            'utf8_lithuanian_ci' => 'Lithuanian, case-insensitive',
            'utf8_persian_ci' => 'Persian, case-insensitive',
            'utf8_polish_ci' => 'Polish, case-insensitive',
            'utf8_roman_ci' => 'West European, case-insensitive',
            'utf8_romanian_ci' => 'Romanian, case-insensitive',
            'utf8_slovak_ci' => 'Slovak, case-insensitive',
            'utf8_slovenian_ci' => 'Slovenian, case-insensitive',
            'utf8_spanish2_ci' => 'Traditional Spanish, case-insensitive',
            'utf8_spanish_ci' => 'Spanish, case-insensitive',
            'utf8_swedish_ci' => 'Swedish, case-insensitive',
            'utf8_turkish_ci' => 'Turkish, case-insensitive',
            'utf8_unicode_ci' => 'Unicode (multilingual), case-insensitive'
        );

        $database = array(
            'host' => 'localhost',
            'port' => '3306',
            'database' => 'aquill',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'prefix' => 'aquill_',
        );

        if ($temp = Session::get('install.database')) {
            $vars = array_merge($vars, $temp);
        } else {
            $vars = array_merge($vars, $database);
        }

        return View::make('database', $vars);
    }

    public function postDatabase() {
        $database = Input::only(array('driver', 'host', 'port', 'username', 'password', 'database', 'charset', 'prefix'));

        Config::set('database.default', $database['driver']);
        Config::set('database.connections.' . $database['driver'], $database);

        try {
            DB::connection()->first('select now()');
        } catch (Exception $e) {
            Notify::error($e->getMessage());
            return Redirect::to('database');
        };

        Session::put('install.database', $database);

        return Redirect::to('metadata');
    }

    public function getMetadata() {
        if (!Session::get('install.database')) {
            Notify::error('Please enter your database details');
            return Redirect::to('database');
        }

        $vars['messages'] = Notify::read();

        $metadata = array(
            'title' => 'My Awesome Blog',
            'description' => 'It&rsquo;s not just any blog. It&rsquo;s an Aquill blog.',
            'theme' => 'theme',
            'bundles' => 'migrations',
            'url' => rtrim(URL::base(), '/'),
            'index' => 'index.php',
        );

        if ($temp = Session::get('install.metadata')) {
            $vars = array_merge($vars, $temp);
        } else {
            $vars = array_merge($vars, $metadata);
        }

        return View::make('metadata', $vars);
    }

    public function postMetadata() {
        $metadata = Input::only(array('title', 'description', 'theme', 'bundles', 'url', 'index'));

        $rules = array(
            'title' => 'required',
            'description' => 'required'
        );

        $validation = Validator::make($metadata, $rules);

        if ($validation->invalid()) {
            Notify::error(_t('install.language_error'));
            return Redirect::to('metadata');
        }

        Session::put('install.metadata', $metadata);

        return Redirect::to('rewrite');
    }

    public function getRewrite() {
        if (!Session::get('install.database')) {
            Notify::error('Please enter your database details');
            return Redirect::to('database');
        }

        $vars['messages'] = Notify::read();

        $vars['posts'] = array(
            'numeric' => '/archives/{id}',
            'name' => '/archives/{name}',
            'month_name' => '/{year}/{month}/{name}',
            'day_name' => '/{year}/{month}/{day}/{name}',
            'custom' => '',
        );

        $rewrites = array(
            'home' => 'custom',
            'post' => '/archives/{id}.html',
            'page' => '/{name}.html',
            'category' => '/category/{name}',
            'tag' => '/tag/{name}',
            'author' => '/author/{name}'
        );

        if ($temp = Session::get('install.rewrites')) {
            $vars = array_merge($vars, $temp);
        } else {
            $vars = array_merge($vars, $rewrites);
        }

        return View::make('rewrite', $vars);
    }

    public function postRewrite() {
        $rewrites = Input::only(array('home', 'post', 'page', 'category', 'tag', 'author'));

        $custom = Input::get('post_custom');

        if (empty($rewrites['post'])) {
            $rewrites['post'] = $custom;
        } else if (empty($rewrites['post'])) {
            $rewrites['post'] = '/archives/{id}';
        }

        Session::put('install.rewrites', $rewrites);

        return Redirect::to('account');
    }

    public function getAccount() {
        if (!Session::get('install.metadata')) {
            Notify::error('Please enter metadata');
            return Redirect::to('metadata');
        }

        $vars['messages'] = Notify::read();

        $account = array(
            'username' => 'admin',
            'email' => 'youremail@damail.com',
            'password' => ''
        );

        if ($s = Session::get('install.account')) {
            $vars = array_merge($vars, $s);
        } else {
            $vars = array_merge($vars, $account);
        }

        return View::make('account', $vars);
    }

    public function postAccount() {
        $account = Input::only(array('username', 'email', 'password'));

        $rules = array(
            'username' => 'required',
            'email' => 'email',
            'password' => 'required'
        );

        $validation = Validator::make($account, $rules);

        if ($validation->invalid()) {
            Notify::error(_t('install.account_error'));
            return Redirect::to('account');
        }

        Session::put('install.account', $account);

        return Redirect::to('complete');
    }

    public function getComplete() {
        if (!Session::get('install.account')) {
            Notify::error(_t('install.account_error'));
            return Redirect::to('account');
        }

        try {
            Aquill::setup();
            return View::make('complete', $vars);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}