<?php

class ExtendController extends AdminController
{
    public function settings() {

        $vars['messages'] = Notify::read();

        $meta = DB::table('meta')->get();

        foreach ($meta as $m) {
            $vars[$m->key] = $m->value;
        }

        return View::make('extend/settings', $vars);
    }

    public function themes() {
        $vars['messages'] = Notify::read();

        $meta = DB::table('meta')->get();

        foreach ($meta as $m) {
            $vars[$m->key] = $m->value;
        }

        return View::make('extend/settings', $vars);
    }

    public function bundles() {
        $vars['messages'] = Notify::read();

        $meta = DB::table('meta')->get();

        foreach ($meta as $m) {
            $vars[$m->key] = $m->value;
        }

        return View::make('extend/settings', $vars);
    }
}