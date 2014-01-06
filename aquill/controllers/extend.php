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
            return Redirect::to('admin/settings');
        }
        
        foreach ($options as $name => $option) {
            $temp['value'] = $option;
            DB::table('options')->where('name', '=', $name)->update($temp);
        }

        Notify::success(__('extend.success'));

        return Redirect::to('admin/general');
    }

    public function getThemes()
    {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        $vars['themes'] = Theme::all();

        return View::make('extend/themes', $vars);
    }

    public function postThemes()
    {
        Input::only(array('site_title', 'site_description', 'site_color'));
        $input = Input::get();

        dd($input);
    }

    public function getUrls()
    {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        foreach ($options as $option) {
            $vars[$option->name] = $option->value;
        }

        return View::make('extend/bundles', $vars);
    }

    public function postUrls()
    {

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

    public function getBundles()
    {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        foreach ($options as $option) {
            $vars[$option->name] = $option->value;
        }

        return View::make('extend/bundles', $vars);
    }

    public function postBundles()
    {

    }

}