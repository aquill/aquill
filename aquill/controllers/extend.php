<?php

class ExtendController extends AdminController
{
    public $restful = true;

    public function getGeneral()
    {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        $vars['languages'] = Config::get('languages');
        $vars['timezones'] = Config::get('timezones');

        foreach ($options as $option) {
            $vars[$option->name] = $option->value;
        }

        return View::make('extend/settings', $vars);
    }

    public function postGeneral()
    {
        $options = Input::only(array('site_title', 'site_description', 
            'language', 'timezone', 'site_color', 'spam_keywords'));
        $options['per_page'] = Input::get('per_page', 20);
        $options['comment_status'] = Input::get('comment_status', 0);
        $options['email_notification'] = Input::get('email_notification', 0);

        $rules = array(
            'site_title' => 'required',
            'site_color' => 'required',
        );

        $validation = Validator::make($options, $rules);

        if ($validation->invalid()) {
            Notify::error(__('extend.error'));
            return Redirect::to('admin/general');
        }
        
        foreach ($options as $name => $option) {
            $temp['value'] = $option;
            DB::table('options')->where('name', '=', $name)->update($temp);
        }

        Notify::success(__('extend.success'));

        return Redirect::to('admin/general');
    }

    public function getUrls()
    {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->where('name', 'like', 'rewrite_%')->get();

        foreach ($options as $option) {
            $vars[$option->name] = $option->value;
        }

        $vars['posts'] = array(
            'numeric' => '/archives/{id}',
            'name' => '/archives/{name}',
            'month_name' => '/{year}/{month}/{name}',
            'day_name' => '/{year}/{month}/{day}/{name}',
            'custom' => '',
        );

        return View::make('extend/urls', $vars);
    }

    public function postUrls()
    {
        $urls = Input::only(array('rewrite_home', 'rewrite_page', 'rewrite_category', 
            'rewrite_tag', 'rewrite_author'));

        $post = Input::get('rewrite_post');
        $custom = Input::get('rewrite_post_custom', '/archives/{id}');

        $urls['rewrite_post'] = Input::get('rewrite_post', '') == '' ? $custom : $post;


        $rules = array(
            'rewrite_home' => 'required',
            'rewrite_post' => 'required',
            'rewrite_page' => 'required',
            'rewrite_category' => 'required',
            'rewrite_tag' => 'required',
            'rewrite_author' => 'required',
        );

        $validation = Validator::make($urls, $rules);

        if ($validation->invalid()) {
            Notify::error(__('extend.error'));
            return Redirect::to('admin/urls');
        }

        foreach ($urls as $name => $option) {
            $temp['value'] = $option;
            DB::table('options')->where('name', '=', $name)->update($temp);
        }

        Notify::success(__('extend.success'));

        return Redirect::to('admin/urls');
    }

    public function getMailer()
    {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        foreach ($options as $option) {
            $vars[$option->name] = $option->value;
        }

        return View::make('extend/bundles', $vars);
    }

    public function postMailer()
    {

    }

    public function getThemes()
    {
        $vars['messages'] = Notify::read();

        $vars['themes'] = Info::themes();

        return View::make('extend/themes', $vars);
    }

    public function postThemes()
    {
        $theme['name'] = Input::get('site_theme');

        DB::table('options')->where('name', '=', 'site_theme')->update($theme);

        Notify::success(__('extend.success'));

        return Redirect::to('admin/themes');
    }

    public function getBundles()
    {
        $vars['messages'] = Notify::read();

        $vars['bundles'] = Info::bundles();

        $options = DB::table('options')->where('name', '=', 'site_bundles')->first();

        $vars['activation'] = explode(',', $options->value);

        return View::make('extend/bundles', $vars);
    }

    public function postBundles()
    {
        $bundle = Input::get('bundle');

        $options = DB::table('options')->where('name', '=', 'site_bundles')->first();

        $activation = explode(',', $options->value);

        if (in_array($bundle, $activation)) {
            foreach ($activation as $key => $value) {
                if ($value == $bundle) {
                    unset($activation[$key]);
                    break;
                }
            }
        } else {
            $activation[] = $bundle;
        }

        $bundles['value'] = implode(',', $activation);

        DB::table('options')->where('name', '=', 'site_bundles')->update($bundles);

        Notify::success(__('extend.success'));

        return Redirect::to('admin/bundles');
    }

}