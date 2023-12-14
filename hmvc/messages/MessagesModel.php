<?php
namespace hmvc\messages;
use gaucho\model;
use gaucho\snow;
class MessagesModel extends model{
	function createMessage($message){
		$unixTime=time();
		$data=[
			'message'=>$message,
			'created_at'=>$unixTime
		];
		if($this->db()->insert('messages',$data)){
			$messageId=$this->db()->id();
			$snow=new snow();
			$machineId=1;
			$sequenceNumber=$this->getSequenceNumber(
				$messageId,
				$unixTime
			);
			$where=[
				'id'=>$messageId
			];
			$data=[
				'snow'=>$snow->encode(
					$unixTime,
					$machineId,
					$sequenceNumber
				)
			];
			$this->update($data,$where);
			return $snow;
		}else{
			return false;
		}
	}
	function getSequenceNumber($messageId,$unixTime){
		$where=[
			'created_at'=>$unixTime,
			'id[<=]'=>$messageId
		];
		return $this->db()->count('messages',$where);
	}
	function readAll($where=false){
		if(!$where){
			$where=[
				'ORDER'=>['id'=>'DESC']
			];
		}
		$cols=['message','created_at','snow'];
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
	function readBySnow($snow){
		$where=[
			'snow'=>$snow
		];
		return $this->readAll($snow);
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