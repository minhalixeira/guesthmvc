<?php
namespace hmvc\messages;
class c{
	private function createMessage($message){
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
			print $messageId;
		}else{
			die('mensagem inválida');
		}
	}
	private function validMessage($message){
		$message=trim($message);
		$len=mb_strlen($message);
		if($len>=1 AND $len<=128){
			return $message;
		}else{
			return false;
		}
	}
}