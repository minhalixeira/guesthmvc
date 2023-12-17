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
			$tableName='messages';
			$sequenceNumber=$snow->getSequenceNumber(
				$messageId,
				$tableName,
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