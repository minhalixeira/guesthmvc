<?php
namespace gaucho;
use gaucho\routes;
use gaucho\view;
class controller {
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
	function view($viewName,$data=[]){
		if(!isset($this->view)){
			$this->view=new view();
		}
		return $this->view->render($viewName,$data);
	}
}