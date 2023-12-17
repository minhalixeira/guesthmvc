<?php
namespace gaucho;
use gaucho\routes;
use gaucho\chaplin;
class controller extends chaplin{
	var $routes;
	var $view;
	function redirect($url){
		header('Location: '.$url);
		die();
	}
	function segment($segment=null){
		if(!isset($this->routes)){
			$this->routes=new routes();
		}
		return $this->routes->segment($segment);
	}
	function view(
		$viewName,$data=[],$print=true
	){
		$data['SITE_URL']=$_ENV['SITE_URL'];
		$data['SITE_NAME']=$_ENV['SITE_NAME'];
		$arr=explode('/',$viewName);
		$hmvc=$arr[0];
		unset($arr[0]);
		$viewName=implode('/',$arr);
		$filename=HMVC.'/'.$hmvc.'/view/'.$viewName.'.html';
		$out=parent::renderFromFile($filename,$data);
		if($print){
			print $out;
		}else{
			return $out;
		}
	}
}