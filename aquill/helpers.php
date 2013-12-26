<?php

function admin_include($filename)
{
    if (is_readable($path = APP . 'views/partials/' . $filename . EXT)) {
        return require $path;
    }
}

function theme_include($filename)
{
    if (is_readable($path = APP . 'themes/default/' . $filename . EXT)) {
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