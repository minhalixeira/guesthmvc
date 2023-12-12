<?php
namespace hmvc\messages;
class c{
	function POST(){
		// validar mensagem
		$message=$_POST['message'];
		if($this->validMessage($message)){
			// salvar mensagem no banco de dados
		}else{
			die('mensagem inválida');
		}
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