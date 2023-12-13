<?php
namespace hmvc\home;
use hmvc\messages\MessagesModel;
use gaucho\view;
use gaucho\controller;
class HomeController extends controller{
	function GET(){
		$MessagesModel=new MessagesModel();
		$data=[
			'title'=>'Guest HMVC',
			'messages'=>$MessagesModel->readAll()
		];
		$this->view('home/head',$data);
		$this->view('home/home',$data);
	}
}
