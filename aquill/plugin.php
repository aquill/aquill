<?php

// Initialize the filter globals.
global $wp_filter, $wp_actions, $merged_filters, $wp_current_filter;

if (!isset($wp_filter))
    $wp_filter = array();

if (!isset($wp_actions))
    $wp_actions = array();

if (!isset($merged_filters))
    $merged_filters = array();

if (!isset($wp_current_filter))
    $wp_current_filter = array();

function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
{
    global $wp_filter, $merged_filters;

    $idx = _wp_filter_build_unique_id($tag, $function_to_add, $priority);
    $wp_filter[$tag][$priority][$idx] = array('function' => $function_to_add, 'accepted_args' => $accepted_args);
    unset($merged_filters[$tag]);
    return true;
}

function has_filter($tag, $function_to_check = false)
{
    global $wp_filter;

    $has = !empty($wp_filter[$tag]);
    if (false === $function_to_check || false == $has)
        return $has;

    if (!$idx = _wp_filter_build_unique_id($tag, $function_to_check, false))
        return false;

    foreach ((array)array_keys($wp_filter[$tag]) as $priority) {
        if (isset($wp_filter[$tag][$priority][$idx]))
            return $priority;
    }

    return false;
}

function apply_filters($tag, $value)
{
    global $wp_filter, $merged_filters, $wp_current_filter;

    $args = array();

    // Do 'all' actions first
    if (isset($wp_filter['all'])) {
        $wp_current_filter[] = $tag;
        $args = func_get_args();
        _wp_call_all_hook($args);
    }

    if (!isset($wp_filter[$tag])) {
        if (isset($wp_filter['all']))
            array_pop($wp_current_filter);
        return $value;
    }

    if (!isset($wp_filter['all']))
        $wp_current_filter[] = $tag;

    // Sort
    if (!isset($merged_filters[$tag])) {
        ksort($wp_filter[$tag]);
        $merged_filters[$tag] = true;
    }

    reset($wp_filter[$tag]);

    if (empty($args))
        $args = func_get_args();

    do {
        foreach ((array)current($wp_filter[$tag]) as $the_)
            if (!is_null($the_['function'])) {
                $args[1] = $value;
                $value = call_user_func_array($the_['function'], array_slice($args, 1, (int)$the_['accepted_args']));
            }

    } while (next($wp_filter[$tag]) !== false);

    array_pop($wp_current_filter);

    return $value;
}

function apply_filters_ref_array($tag, $args)
{
    global $wp_filter, $merged_filters, $wp_current_filter;

    // Do 'all' actions first
    if (isset($wp_filter['all'])) {
        $wp_current_filter[] = $tag;
        $all_args = func_get_args();
        _wp_call_all_hook($all_args);
    }

    if (!isset($wp_filter[$tag])) {
        if (isset($wp_filter['all']))
            array_pop($wp_current_filter);
        return $args[0];
    }

    if (!isset($wp_filter['all']))
        $wp_current_filter[] = $tag;

    // Sort
    if (!isset($merged_filters[$tag])) {
        ksort($wp_filter[$tag]);
        $merged_filters[$tag] = true;
    }

    reset($wp_filter[$tag]);

    do {
        foreach ((array)current($wp_filter[$tag]) as $the_)
            if (!is_null($the_['function']))
                $args[0] = call_user_func_array($the_['function'], array_slice($args, 0, (int)$the_['accepted_args']));

    } while (next($wp_filter[$tag]) !== false);

    array_pop($wp_current_filter);

    return $args[0];
}

function remove_filter($tag, $function_to_remove, $priority = 10)
{
    $function_to_remove = _wp_filter_build_unique_id($tag, $function_to_remove, $priority);

    $r = isset($GLOBALS['wp_filter'][$tag][$priority][$function_to_remove]);

    if (true === $r) {
        unset($GLOBALS['wp_filter'][$tag][$priority][$function_to_remove]);
        if (empty($GLOBALS['wp_filter'][$tag][$priority]))
            unset($GLOBALS['wp_filter'][$tag][$priority]);
        unset($GLOBALS['merged_filters'][$tag]);
    }

    return $r;
}

function remove_all_filters($tag, $priority = false)
{
    global $wp_filter, $merged_filters;

    if (isset($wp_filter[$tag])) {
        if (false !== $priority && isset($wp_filter[$tag][$priority]))
            unset($wp_filter[$tag][$priority]);
        else
            unset($wp_filter[$tag]);
    }

    if (isset($merged_filters[$tag]))
        unset($merged_filters[$tag]);

    return true;
}

function current_filter()
{
    global $wp_current_filter;
    return end($wp_current_filter);
}

function _wp_call_all_hook($args)
{
    global $wp_filter;

    reset($wp_filter['all']);
    do {
        foreach ((array)current($wp_filter['all']) as $the_)
            if (!is_null($the_['function']))
                call_user_func_array($the_['function'], $args);

    } while (next($wp_filter['all']) !== false);
}

function _wp_filter_build_unique_id($tag, $function, $priority)
{
    global $wp_filter;
    static $filter_id_count = 0;

    if (is_string($function))
        return $function;

    if (is_object($function)) {
        // Closures are currently implemented as objects
        $function = array($function, '');
    } else {
        $function = (array)$function;
    }

    if (is_object($function[0])) {
        // Object Class Calling
        if (function_exists('spl_object_hash')) {
            return spl_object_hash($function[0]) . $function[1];
        } else {
            $obj_idx = get_class($function[0]) . $function[1];
            if (!isset($function[0]->wp_filter_id)) {
                if (false === $priority)
                    return false;
                $obj_idx .= isset($wp_filter[$tag][$priority]) ? count((array)$wp_filter[$tag][$priority]) : $filter_id_count;
                $function[0]->wp_filter_id = $filter_id_count;
                ++$filter_id_count;
            } else {
                $obj_idx .= $function[0]->wp_filter_id;
            }

            return $obj_idx;
        }
    } else if (is_string($function[0])) {
        // Static Calling
        return $function[0] . '::' . $function[1];
    }
}
