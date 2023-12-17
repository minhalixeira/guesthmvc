<?php
namespace gaucho;
use gaucho\chaplin;
class view extends chaplin{
	function render(
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