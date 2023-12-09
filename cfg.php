<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__.'/vendor/autoload.php';

define('HMVC',__DIR__.'/hmvc');

use gaucho\env;
use gaucho\routes;

// env
$env=new env();
$env->load(__DIR__.'/.env');

// db
$db=new Medoo([
    'type'=>'sqlite',
    'database'=>'db/db.sqlite3'
]);

// rota
$routes=new routes();
$routes->load(__DIR__.'/routes.php');