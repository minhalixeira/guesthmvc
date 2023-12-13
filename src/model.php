<?php
namespace gaucho;
use Medoo\Medoo;
class model{
	var $db;
	function db(){
		if(!isset($this->db)){
			$this->setDb();
		}
		return $this->db;
	}
	function setDb(){
		if($_ENV['DB_TYPE']=='sqlite'){
			$this->db=new Medoo([
				'type'=>'sqlite',
				'database'=>ROOT.'/db/db.sqlite3'
			]);
		}else{
			$this->db=new Medoo([
				'type'=>'mysql',
				'host'=>'localhost',
				'database'=>$_ENV['MYSQL_DB'],
				'username'=>$_ENV['MYSQL_USER'],
				'password'=>$_ENV['MYSQL_PASSWORD'],
				'charset'=>'utf8mb4',
				'collation'=>'utf8mb4_unicode_ci',
				'port'=>3306
			]);
		}
	}
}