<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__.'/vendor/autoload.php';

define('HMVC',__DIR__.'/hmvc');

use Medoo\Medoo;
use gaucho\env;
// env
$env=new env();
$env->load(__DIR__.'/.env');

// db
$db=new Medoo([
	'type'=>'sqlite',
	'database'=>__DIR__.'/db/db.sqlite3'
]);