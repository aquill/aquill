<?php

class ExtendController extends AdminController
{
    public function settings() {

        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        foreach ($options as $option) {
            $vars[$option->key] = $option->value;
        }

        return View::make('extend/settings', $vars);
    }

    public function themes() {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        foreach ($options as $option) {
            $vars[$option->key] = $option->value;
        }

        return View::make('extend/settings', $vars);
    }

    public function bundles() {
        $vars['messages'] = Notify::read();

        $options = DB::table('options')->get();

        foreach ($options as $option) {
            $vars[$option->key] = $option->value;
        }

        return View::make('extend/settings', $vars);
    }
}