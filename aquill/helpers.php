<?php

function admin_include($filename)
{
    if (is_readable($path = APP . 'views/partials/' . $filename . EXT)) {
        return require $path;
    }
}

function theme_include($filename)
{
    if (is_readable($path = PATH . 'themes/default/' . $filename . EXT)) {
        return require $path;
    }
}

function is_admin()
{
    return strpos(URL::current(), 'admin') !== 0;
}

function body_class($classes = '')
{
    $classes .= str_replace('/', ' ', URI::current());

    return 'class="' . $classes . '"';
}

function is_page($page = 'admin')
{
    return strpos(URL::current(), $page) !== false;
}

function permalink($vars)
{
    $permalink = Config::get('app.permalink');

    foreach ($vars as $key => $value) {
        if (strpos($permalink, '{' . $key . '}') !== false) {
            $permalink = str_replace('{' . $key . '}', $value, $permalink);
        }
    }

    return $permalink;
}

function rule_by_id()
{
    $permalink = Config::get('app.permalink');

    if (strpos($permalink, '{id}') !== false) {
        return true;
    }
    return false;
}

function permalink_rule()
{
    $patterns['year'] = '[0-9]+';
    $patterns['month'] = '[0-9]+';
    $patterns['day'] = '[0-9]+';

    if (rule_by_id()) {
        $patterns['id'] = '(:num)';
        $patterns['name'] = '.*';
    } else {
        $patterns['id'] = '[0-9]+';
        $patterns['name'] = '(.*)';
    }

    return trim(permalink($patterns), '/');
}