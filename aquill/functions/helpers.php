<?php

function add_theme_script() {}

function add_theme_style() {}

function get_avatar() {}

function is_admin() {}

function is_home() {}

function is_page() {}

function is_post() {}

function theme_asset() {}

function theme_footer() {}

function theme_header() {}

function theme_include($filename) {
    if (is_readable($path = PATH . 'themes/default/' . $filename . EXT)) {
        return require $path;
    }
}

function theme_scripts() {}

function theme_styles() {}

function site_title() {}

function site_description() {}

function site_navigation() {}