<?php
namespace gaucho;
use Medoo\Medoo;
class db{
	var $db;
	function getDb(){
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
			die('db '.$_ENV['DB_TYPE'].' não suportado');
		}
	}
}