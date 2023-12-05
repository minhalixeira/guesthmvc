<?php
require __DIR__.'/../cfg.php';

use gaucho\mig;

$pdo=$db->pdo;
$dbType='sqlite';
$tableDirectory=glob($_ENV['SITE_ROOT'].'/hmvc/*/table');
$mig=new mig($pdo,$tableDirectory,$dbType);
$mig->mig();
