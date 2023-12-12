<?php
namespace gaucho;
use gaucho\mustache;
class view extends mustache{
	var $print;
	function __construct($print=true){
		$this->print=$print;
	}
	function render($viewName,$data=[]){
		$filename=HMVC.'/'.$viewName.'.html';
		$out=parent::renderFromFile($filename);
		if($this->print){
			print $out;
		}else{
			return $out;
		}
	}
}