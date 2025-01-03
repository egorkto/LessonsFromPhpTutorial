<?php

namespace App\Services;

class Page
{
    public static function part($name)
    {
        require_once 'views/components/'.$name.'.php';
    }
}
