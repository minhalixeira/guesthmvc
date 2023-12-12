<?php
namespace gaucho;
use gaucho\mustache;
class view extends mustache{
	var $print;
	function __construct($print=true){
		$this->print=$print;
	}
	function render($viewName,$data=[]){
		$data['SITE_URL']=$_ENV['SITE_URL'];
		$data['SITE_NAME']=$_ENV['SITE_NAME'];
		$arr=explode('/',$viewName);
		$hmvc=$arr[0];
		unset($arr[0]);
		$viewName=implode('/',$arr);
		$filename=HMVC.'/'.$hmvc.'/view/'.$viewName.'.html';
		$out=parent::renderFromFile($filename,$data);
		if($this->print){
			print $out;
		}else{
			return $out;
		}
	}
}