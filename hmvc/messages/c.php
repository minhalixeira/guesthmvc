<?php
namespace hmvc\messages;
class c{
	function createMessage($message){
		global $db;		
		$data=[
			'message'=>$message,
			'created_at'=>time()
		];
		if($db->insert('messages',$data)){
			return $db->id();
		}else{
			return false;
		}
	}
	function POST(){
		// validar mensagem
		$message=$this->validMessage($_POST['message']);
		if($message){
			// salvar mensagem no banco de dados
			$messageId=$this->createMessage($message);
			if($messageId){
				header('Location: '.$_ENV['SITE_URL']);
			}else{
				die("erro ao criar mensagem");
			}
		}else{
			die('mensagem inválida');
		}
	}
	function readAll(){
		global $db;
		$where=[
			'ORDER'=>['id'=>'DESC']
		];
		return $db->select('messages','*',$where);
	}
	function validMessage($message){
		$message=trim($message);
		$len=mb_strlen($message);
		if($len>=1 AND $len<=128){
			return $message;
		}else{
			return false;
		}
	}
}