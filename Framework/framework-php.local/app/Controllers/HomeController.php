<?php

namespace App\Controllers;

use Somecode\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        $content = '<h1>Hello</h1>';

        return new Response($content);
    }
}
