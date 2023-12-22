<?php
namespace hmvc\home;
use hmvc\messages\MessagesModel;
use gaucho\view;
use gaucho\controller;
class HomeController extends controller{
	function GET(){
		$MessagesModel=new MessagesModel();
		$messages=$MessagesModel->readAll();
		$data=[
			'messages'=>$messages
		];
		$messagesStr=$this->view(
			'messages/loop',$data,false
		);
		$data=[
			'title'=>$_ENV['SITE_NAME'],
			'messages'=>$messagesStr,
			'topo'=>$this->view('home/topo',[],false)
		];
		$this->view('home/head',$data);
		$this->view('home/read',$data);
	}
}
