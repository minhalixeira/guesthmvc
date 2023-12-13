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
		$snow=$this->segment(2);
		$messages=$this->model->readBySnow($snow);
		$data=[
			'title'=>$messages[0]['message'],
			'messages'=>$messages
		];
		$this->view('home/head',$data);
		$this->view('messages/messages',$data);		
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