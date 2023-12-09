<?php
require __DIR__.'/../cfg.php';

use gaucho\mig;

$pdo=$db->pdo;
$dbType='sqlite';
$tableDirectory=glob(HMVC.'/*/table');
$mig=new mig($pdo,$tableDirectory,$dbType);
$mig->mig();
