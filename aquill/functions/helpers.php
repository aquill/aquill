<?php

function add_theme_script($container = 'header', $name, $source, $dependencies = array(), $attributes = array()) {
    return Asset::container('theme_'.$container)->script($name, $source, $dependencies, $attributes);
}

function add_theme_style($container = 'header', $name, $source, $dependencies = array(), $attributes = array()) {
    return Asset::container('theme_'.$container)->style($name, $source, $dependencies, $attributes);
}

function add_theme_asset($container = 'header', $name, $source, $dependencies = array(), $attributes = array()) {
    return Asset::container('theme_'.$container)->add($name, $source, $dependencies, $attributes);
}

function autop($pee, $br = true) {
    $pre_tags = array();

    if (trim($pee) === '')
        return '';

    $pee = $pee . "\n"; // just to make things a little easier, pad the end

    if (strpos($pee, '<pre') !== false) {
        $pee_parts = explode('</pre>', $pee);
        $last_pee = array_pop($pee_parts);
        $pee = '';
        $i = 0;

        foreach ($pee_parts as $pee_part) {
            $start = strpos($pee_part, '<pre');

            // Malformed html?
            if ($start === false) {
                $pee .= $pee_part;
                continue;
            }

            $name = "<pre wp-pre-tag-$i></pre>";
            $pre_tags[$name] = substr($pee_part, $start) . '</pre>';

            $pee .= substr($pee_part, 0, $start) . $name;
            $i++;
        }

        $pee .= $last_pee;
    }

    $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
    // Space things out a little
    $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|noscript|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
    $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
    $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
    $pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
    if (strpos($pee, '<object') !== false) {
        $pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
        $pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
    }
    $pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
    // make paragraphs, including one at the end
    $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
    $pee = '';
    foreach ($pees as $tinkle)
        $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
    $pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
    $pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
    $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
    $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
    $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
    $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
    if ($br) {
        $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);
        $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
        $pee = str_replace('<PreserveNewline />', "\n", $pee);
    }
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
    $pee = preg_replace("|\n</p>$|", '</p>', $pee);

    if (!empty($pre_tags))
        $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

    return $pee;
}

function body_class($classes = '') {
    $classes .= str_replace('/', ' ', URI::current());

    return 'class="' . $classes . '"';
}

function csrf_token() {
    return Session::token();
}

function csrf_token_input() {
    return '<input type="hidden" name="csrf_token" value="'.csrf_token().'">';
}

function get_avatar() {}

function get_by_id($type = 'post') {
    $rewrite = get_option('rewrite_'.strtolower($type));

    if (strpos($rewrite, '{id}') !== false) {
        return true;
    }

    return false;
}

function get_option($key, $default = null) {
    if (is_null(Registry::get('options'))) {
        $options = array();
        $data = DB::table('options')->get();

        foreach ($data as $option) {
            $options[$option->key] = $option->value;
        }

        Registry::set('options', $options);
    }

    $options = Registry::get('options');

    if (isset($options[$key])) {
        return $options[$key];
    }

    return $default;
}

function is_admin() {}

function is_home() {}

function is_page() {}

function is_post() {}

function is_url($string) {
    if (strpos($string, 'http://') !== false) {
        return true;
    } elseif (strpos($string, 'https://') !== false) {
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

function rewrite($arr ,$type = 'post') {
    $rewrite = get_option('rewrite_'.strtolower($type));

    foreach ($arr as $key => $value) {
        if (strpos($rewrite, '{' . $key . '}') !== false) {
            $rewrite = str_replace('{' . $key . '}', $value, $rewrite);
        }
    }

    return $rewrite;
}

function theme_asset() {}

function theme_footer() {}

function theme_header() {}

function theme_include($filename) {
    if (is_readable($path = PATH . 'themes/default/' . $filename . EXT)) {
        return require $path;
    }
}

function theme_scripts($container = 'header') {
    return Asset::container('theme_'.$container)->scripts();
}

function theme_styles($container = 'header') {
    return Asset::container('theme_'.$container)->styles();
}

function site_head_title() {
    $description = site_title();
    $title = site_title();

    if (!is_null($post = Registry::get('post'))) {
        $title = $post->title;
    } elseif (!is_null($page = Registry::get('page'))) {
        $title = $page->title;
    } elseif (!is_null($category = Registry::get('category'))) {
        $title = $category->name;
    } elseif (!is_null($tag = Registry::get('tag'))) {
        $title = $tag->name;
    } elseif (!is_null($author = Registry::get('author'))) {
        $title = $author->nicename;
    } else {
        $description = site_description();
    }

    $head_title = $title . ' - ' . $description;

    return apply_filters('site_head_title', $head_title);
}

function site_title() {
    return get_option('site_title');
}

function site_description() {
    return get_option('site_description');
}

function site_menu_list() {
    $menus = Registry::get('menus', array());
    foreach ($menus as $menu) {
        printf('<li><a href="%s">%s</a></li>', $menu->link(), $menu->title());
    }
}

function uri_has($page = 'admin') {
    return strpos(URL::current(), $page) !== false;
}

function _autop_newline_preservation_helper($matches) {
    return str_replace("\n", "<PreserveNewline />", $matches[0]);
}
