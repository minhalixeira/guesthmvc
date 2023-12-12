<?php
namespace hmvc\home;
use hmvc\messages\MessagesController;
use gaucho\view;
class HomeController{
	var $view;
	function __construct(){
		$this->view=new view();
	}
	function GET(){
		$MessagesController=new MessagesController();
		$data=[
			'title'=>'Guest HMVC',
			'messages'=>$MessagesController->readAll()
		];
		$this->view->render('home/head',$data);
		$this->view->render('home/home',$data);
	}
}
