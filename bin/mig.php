<?php
require __DIR__.'/../cfg.php';

use gaucho\model;
use gaucho\mig;

$model=new model();
$db=$model->db();
$pdo=$db->pdo;
$dbType=$db->info()['driver'];
$tableDirectory=glob(HMVC.'/*/table');
$mig=new mig($pdo,$tableDirectory,$dbType);
$mig->mig();
