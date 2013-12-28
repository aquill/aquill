<?php

class Comment extends Eloquent
{

    public static $table = 'comments';

    public static $timestamps = false;

    public static $rules = array(
        'name' => 'required',
        'email' => 'required|email',
        'text' => 'required'
    );

}