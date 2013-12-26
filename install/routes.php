<?php

/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
*/
Route::get('/, start', function () {
    $vars['messages'] = Notify::read();
    $vars['languages'] = array('en_GB', 'zh_CN');
    $vars['timezones'] = timezones();
    $i18n = array(
        'language' => 'zh_CN',
        'timezone' => current_timezone()
    );

    if ($temp = Session::get('install.i18n')) {
        $vars = array_merge($vars, $temp);
    } else {
        $vars = array_merge($vars, $i18n);
    }

    return View::make('start', $vars);
});

Route::post('start', array('before'=> 'csrf', function () {
    $i18n = Input::only(array('language', 'timezone'));
    $rules = array(
        'language' => 'required',
        'timezone' => 'required'
    );

    $validation = Validator::make($i18n, $rules);

    if ($validation->invalid()) {
        Notify::error('Please select a language');
        return Redirect::to('start');
    }

    Session::put('install.i18n', $i18n);

    return Redirect::to('database');
}));

Route::get('database', function () {
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
        'prefix' => 'anchor_',
    );

    if ($temp = Session::get('install.database')) {
        $vars = array_merge($vars, $temp);
    } else {
        $vars = array_merge($vars, $database);
    }

    return View::make('database', $vars);
});

Route::post('database', array('before'=> 'csrf', function () {
    $database = Input::only(array('driver', 'host', 'port', 'username', 'password', 'database', 'charset', 'prefix'));

    try {
        DB::connection($database['driver'], array(
            'driver' => $database['driver'],
            'host' => $database['host'],
            'port' => $database['port'],
            'database' => $database['database'],
            'username' => $database['username'],
            'password' => $database['password'],
            'charset' => 'utf8',
            'prefix' => $database['prefix'],
        ))->first('select now()');
    } catch (Exception $e) {
        Notify::error($e->getMessage());

        return Redirect::to('database');
    };

    Session::put('install.database', $database);

    return Redirect::to('metadata');
}));

Route::get('metadata', function () {
    if (!Session::get('install.database')) {
        Notify::error('Please enter your database details');
        return Redirect::to('database');
    }

    $vars['messages'] = Notify::read();

    $metadata = array(
        'title' => 'My First Anchor Blog',
        'description' => 'It&rsquo;s not just any blog. It&rsquo;s an Anchor blog.',
        'url' => rtrim(rtrim(URL::base(),'install'),'/'),
        'index' => 'index.php',
    );

    if ($temp = Session::get('install.metadata')) {
        $vars = array_merge($vars, $temp);
    } else {
        $vars = array_merge($vars, $metadata);
    }

    return View::make('metadata', $vars);
});

Route::post('metadata', array('before'=> 'csrf', function () {
    $metadata = Input::only(array('title', 'description', 'url', 'index'));
    
    $rules = array(
        'url' => 'required',
        'index' => 'required'
    );

    $validation = Validator::make($metadata, $rules);

    if ($validation->invalid()) {
        Notify::error('Please select a language');
        return Redirect::to('metadata');
    }

    Session::put('install.metadata', $metadata);
    
    return Redirect::to('account');
}));

Route::get('account', function () {
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
});

Route::post('account', array('before'=> 'csrf', function () {
    $account = Input::only(array('username', 'email', 'password'));

    $rules = array(
        'username' => 'required',
        'email' => 'email',
        'password' => 'required'
    );

    $validation = Validator::make($account, $rules);

    if ($validation->invalid()) {
        Notify::error('Please enter a account');
        return Redirect::to('account');
    }

    Session::put('install.account', $account);

    return Redirect::to('complete'); 
}));

Route::get('complete', function () {
    if (!Session::get('install.account')) {
        Notify::error('Please select a account');
        return Redirect::to('account');
    }

    $vars['messages'] = Notify::read();

    echo '<pre>' ;
    var_dump(Session::get('install'));
    echo '</pre>' ;
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
*/
Event::listen('404', function () {
    return Response::error('404');
});

Event::listen('500', function () {
    return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/
Route::filter('csrf', function () {
    if (Request::forged()) return Response::error('500');
});
