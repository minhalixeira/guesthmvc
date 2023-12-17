<?php
namespace gaucho;

class chaplin{
	function renderFromString($str,$data){
		$arr=[];
		foreach ($data as $key => $value) {
			if(is_string($value)){
				$evalue=htmlentities($value);	
				$arr['{{'.$key.'}}']=$evalue;
				$arr['{{&'.$key.'}}']=$value;	
			}
			if(is_array($value)){
				foreach ($value as $k2 => $v2) {
					if(is_array($v2)){
						$msg='chaplin ';
						$msg.='error: <b>';
						$msg.=htmlentities(
							$key
						);
						$msg.='</b> must be';
						$msg.=' a string';
						die($msg);
					}
					$keyX=$key.'.'.$k2;
					$ev2=htmlentities($v2);	
					$arr['{{'.$keyX.'}}']=$ev2;
					$arr['{{&'.$keyX.'}}']=$v2;
				}
			}
		}
		return strtr($str, $arr);
	}
	function renderFromFile($filename,$data=[]){
		if(file_exists($filename)){
			$template=file_get_contents($filename);
			return $this->renderFromString(
				$template,$data
			);
		}else{
			die(htmlentities($filename).' not found');
		}
	}
}