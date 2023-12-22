<?php
namespace hmvc\messages;
use gaucho\model;
use gaucho\flake;
class MessagesModel extends model{
	function createMessage($message){
		$unixTime=time();
		$data=[
			'message'=>$message,
			'created_at'=>$unixTime
		];
		if($this->db()->insert('messages',$data)){
			$messageId=$this->db()->id();
			$flake=new flake();
			$machineId=1;
			$tableName='messages';
			$sequenceNumber=$flake->getSequenceNumber(
				$messageId,
				$tableName,
				$unixTime
			);
			$where=[
				'id'=>$messageId
			];
			$data=[
				'flake'=>$flake->encode(
					$unixTime,
					$machineId,
					$sequenceNumber
				)
			];
			$this->update($data,$where);
			return $flake;
		}else{
			return false;
		}
	}
	function readAll($where=false){
		if(!$where){
			$where=[
				'ORDER'=>['id'=>'DESC']
			];
		}
		$cols=['message','created_at','flake'];
		$arr=$this->db()->select('messages',$cols,$where);
		if($arr){
			foreach ($arr as $key => $value) {
				$arr[$key]['created_at_h']=date(
					"r",$value['created_at']
				);
			}
		}
		return $arr;
	}
	function readByFlake($flake){
		$where=[
			'flake'=>$flake
		];
		return $this->readAll($where);
		$where=[
			'flake'=>$flake
		];
		$cols=['message','created_at'];
		$message=$this->db()->get('messages',$cols,$where);
		if($message){
			$message['created_at_h']=date(
				"r",$message['created_at']
			);
		}
		return $message;
	}
	function update($data,$where){
		return $this->db()->update('messages',$data,$where);
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