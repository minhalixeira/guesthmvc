<?php
namespace hmvc\messages;
use hmvc\messages\MessagesModel;
use gaucho\controller;
class MessagesController extends controller{
	var $model;
	function __construct(){
		$this->model=new MessagesModel();
	}
	function GET(){
		$flake=$this->segment(2);
		$message=$this->model->readByFlake($flake);
		$messageStr=$this->view(
			'messages/loop',
			['message'=>$message],
			false
		);
		$data=[
			'title'=>$message['message'],
			'message'=>$messageStr,
			'topo'=>$this->view('home/topo',[],false)
		];
		$this->view('home/head',$data);
		$this->view('messages/read',$data);	
	}
	function POST(){
		// validar mensagem
		$message=$this->model->validMessage(
			$_POST['message']
		);
		if($message){
			// salvar mensagem no banco de dados
			$messageId=$this->model->createMessage(
				$message
			);
			if($messageId){
				$this->redirect($_ENV['SITE_URL']);
			}else{
				die("erro ao criar mensagem");
			}
		}else{
			die('mensagem inválida');
		}
	}

}