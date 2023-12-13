<?php
namespace hmvc\home;
use hmvc\messages\MessagesController;
use gaucho\view;
use gaucho\controller;
class HomeController extends controller{
	function GET(){
		$MessagesController=new MessagesController();
		$data=[
			'title'=>'Guest HMVC',
			'messages'=>$MessagesController->readAll()
		];
		$this->view('home/head',$data);
		$this->view('home/home',$data);
	}
}
