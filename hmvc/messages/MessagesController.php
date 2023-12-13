<?php
namespace hmvc\messages;
use gaucho\db;
use gaucho\controller;
class MessagesController extends controller{
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
	function GET(){
		$messageId=$this->segment(2);
		$messages=$this->readById($messageId);
		$data=[
			'title'=>$messages[0]['message'],
			'messages'=>$messages
		];
		$this->view('home/head',$data);
		$this->view('messages/messages',$data);		
	}
	function POST(){
		// validar mensagem
		$message=$this->validMessage($_POST['message']);
		if($message){
			// salvar mensagem no banco de dados
			$messageId=$this->createMessage($message);
			if($messageId){
				$this->redirect($_ENV['SITE_URL']);
			}else{
				die("erro ao criar mensagem");
			}
		}else{
			die('mensagem inválida');
		}
	}
	function readAll($id=false){
		$where=[
			'ORDER'=>['id'=>'DESC']
		];
		if($id){
			$where=[
				'id'=>$id,
				'LIMIT'=>1
			];
		}
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
	function readById($id){
		return $this->readAll($id);
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