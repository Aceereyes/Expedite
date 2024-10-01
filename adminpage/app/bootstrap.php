<?php
    date_default_timezone_set('Asia/Manila');

    //Autoload
    require('vendor/autoload.php');

    //Global Variables
    require('config/variables.php');
    
    $capsule = new Illuminate\Database\Capsule\Manager;

    $currentEnv = 'local';
    $base_url = config("app.base_url.$currentEnv");

    $capsule->addConnection([
        'driver'    => config("database.$currentEnv.driver"),
        'host'      => config("database.$currentEnv.host"),
        'database'  => config("database.$currentEnv.database"),
        'username'  => config("database.$currentEnv.username"),
        'password'  => config("database.$currentEnv.password"),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => 'tbl_',
    ]);    
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    //Functions
    require('config/functions.php');

    session_start();
?>