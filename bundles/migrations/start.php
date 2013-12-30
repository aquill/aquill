<?php

Route::get('admin/migrations', function () {
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

    if ($temp = Session::get('migrations.database')) {
        $vars = array_merge($vars, $temp);
    } else {
        $vars = array_merge($vars, $database);
    }
    return View::make('migrations::database', $vars);
});

Route::post('admin/migrations', function () {
    $database = Input::only(array('blog', 'driver', 'host', 'port', 'username', 'password', 'database', 'charset', 'prefix'));

    Config::set('database.default', $database['driver']);
    Config::set('database.connections.' . $database['driver'], $database);

    try {
        DB::connection()->first('select now()');
    } catch (Exception $e) {
        Notify::error($e->getMessage());
        return Redirect::to('admin/migrations');
    }

    Session::put('migrations.database', $database);

    return Redirect::to('admin/migrations/' . $database['blog']);
});

Route::get('admin/migrations/wordpress', function () {
    var_dump(Session::get('migrations'));
});

