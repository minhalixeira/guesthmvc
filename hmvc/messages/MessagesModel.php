<?php
namespace hmvc\messages;
use gaucho\model;
class MessagesModel extends model{
	function createMessage($message){
		$data=[
			'message'=>$message,
			'created_at'=>time()
		];
		if($this->db()->insert('messages',$data)){
			return $this->db()->id();
		}else{
			return false;
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
		$arr=$this->db()->select('messages','*',$where);
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