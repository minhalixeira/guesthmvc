<?php
require __DIR__.'/../cfg.php';

use gaucho\db;
use gaucho\mig;

$db=new db();
$db=$db->getDb();
$pdo=$db->pdo;
$dbType=$db->info()['driver'];
$tableDirectory=glob(HMVC.'/*/table');
$mig=new mig($pdo,$tableDirectory,$dbType);
$mig->mig();
