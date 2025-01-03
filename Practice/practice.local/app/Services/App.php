<?php

namespace App\Services;

class App
{
    public static function start()
    {
        self::libs();
        self::db();
    }

    public static function libs()
    {
        $config = require_once 'config/app.php';
        foreach ($config['libs'] as $lib) {
            require_once 'libs/'.$lib.'.php';
        }
    }

    public static function db()
    {
        $config = require_once 'config/db.php';
        $host = $config['host'];
        $port = $config['port'];
        $dbName = $config['db'];
        $username = $config['username'];
        $password = $config['password'];
        if ($config['enable']) {
            \R::setup("mysql:host=$host;port=$port;dbname=$dbName", $username, $password);
        }
        if (! \R::testConnection()) {
            exit('Error database connection!');
        }
    }
}
