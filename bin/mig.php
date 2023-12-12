<?php
require __DIR__.'/../cfg.php';

use gaucho\mig;

$pdo=$db->pdo;
$dbType=$db->info()['driver'];
$tableDirectory=glob(HMVC.'/*/table');
$mig=new mig($pdo,$tableDirectory,$dbType);
$mig->mig();
