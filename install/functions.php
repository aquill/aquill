<?php

function uri_has($page = 'admin') {
    return strpos(URL::current(), $page) !== false;
}

function timezones() {
    $list = DateTimeZone::listAbbreviations();
    $idents = DateTimeZone::listIdentifiers();

    $data = array();

    foreach ($list as $key => $zones) {
        foreach ($zones as $id => $zone) {
            if ($zone['timezone_id'] and in_array($zone['timezone_id'], $idents)) {
                $offset = round(abs($zone['offset'] / 3600));
                $sign = $zone['offset'] > 0 ? '+' : '-';

                if ($offset == 0) {
                    $sign = ' ';
                    $offset = '';
                }

                $zone['label'] = 'GMT' . $sign . $offset . ' ' . $zone['timezone_id'];

                $data[$zone['offset']][$zone['timezone_id']] = $zone;
            }
        }
    }

    ksort($data);

    $timezones = array();

    foreach ($data as $offsets) {

        ksort($offsets);

        foreach ($offsets as $zone) {
            $timezones[] = $zone;
        }
    }

    return $timezones;
}

function languages() {
    return require PATH . 'aquill/config/languages.php';
}

function current_timezone() {
    return Cookie::get('aquill-install-timezone', 0) * 3600;
}

function site_menu_list() {
    $i = 0; $menus = array('start', 'database', 'metadata', 'rewrite', 'account', 'complete');

    foreach ($menus as $key => $menu) {
        if ($i > $key) {
            printf('<li class="%s"><span>%s</span></li>', $menu, _t('install.'.$menu));
        } else {
            if (uri_has($menu)) $i = 6;
            printf('<li class="%s"><a href="%s">%s</a></li>', $menu.' elapsed', url('start'), _t('install.'.$menu));
        }
    }
}
