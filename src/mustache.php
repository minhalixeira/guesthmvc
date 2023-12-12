<?php
namespace gaucho;
class mustache{
	function render($template,$data){

	}
	function renderFromFile($filename,$data){
		if(file_exists($filename)){
			$template=file_get_contents($filename);
			return $this->render($template,$data);
		}else{
			die(htmlentities($filename).' not found');
		}
	}
}