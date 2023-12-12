<?php
namespace hmvc\messages;
use gaucho\db;
class MessagesController{
	var $db;
	function __construct(){
		$dbObj=new db();
		$this->db=$dbObj->getDb();
	}
	function createMessage($message){
		$data=[
			'message'=>$message,
			'created_at'=>time()
		];
		if($this->db->insert('messages',$data)){
			return $this->db->id();
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
		$where=[
			'ORDER'=>['id'=>'DESC']
		];
		$arr=$this->db->select('messages','*',$where);
		if($arr){
			foreach ($arr as $key => $value) {
				$arr[$key]['created_at_h']=date(
					"r",$value['created_at']
				);
			}
		}
		return $arr;
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