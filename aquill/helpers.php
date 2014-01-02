<?php

function markdown($text) {
    return Markdown::defaultTransform($text);
}

function csrf_token() {
    return Session::token();
}

function csrf_token_input() {
    return '<input type="hidden" name="csrf_token" value="'.csrf_token().'">';
}

function body_class($classes = '') {
    $classes .= str_replace('/', ' ', URI::current());

    return 'class="' . $classes . '"';
}

function uri_has($page = 'admin') {
    return strpos(URL::current(), $page) !== false;
}

function rewrite($arr ,$type = 'post') {
    $rewrite = Config::get('rewrite.'.strtolower($type));

    foreach ($arr as $key => $value) {
        if (strpos($rewrite, '{' . $key . '}') !== false) {
            $rewrite = str_replace('{' . $key . '}', $value, $rewrite);
        }
    }

    return $rewrite;
}

function get_by_id($type = 'post') {
    $rewrite = Config::get('rewrite.'.strtolower($type));

    if (strpos($rewrite, '{id}') !== false) {
        return true;
    }

    return false;
}

function pattern($type = 'post') {
    $type = strtolower($type);

    if ($type == 'post') {
        $patterns['year'] = '[0-9]+';
        $patterns['month'] = '[0-9]+';
        $patterns['day'] = '[0-9]+';
        $patterns['category'] = '.*';        
    }

    if (get_by_id($type)) {
        $patterns['id'] = '(:num)';
        $patterns['name'] = '.*';
    } else {
        $patterns['id'] = '[0-9]+';
        $patterns['name'] = '(.*)';
    }

    return trim(rewrite($patterns, $type), '/');
}

function is_url($string) {
    if (strpos($string, 'http://') !== false) {
        return true;
    } elseif (strpos($string, 'https://') !== false) {
        return true;
    }

    return false;
}