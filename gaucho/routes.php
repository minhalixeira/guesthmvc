<?php
namespace gaucho;

class routes{
	var $methodRaw;
	var $routes;
	function call($namespace){
		// $namespace=$this->routes[$this->segment(1)];
		$method=$this->getMethod();
		// verifica se a classe existe
		if(class_exists($namespace)){
			$obj=new $namespace();
		}else{
			die("class ".htmlentities($namespace).' not found');
		}
		// verifica se o método existe na classe
		if(
			method_exists($obj,$method) or 
			method_exists($obj,'GET')
		){
			$obj->$method();
		}else{
			$msg='method '.$method.' not found at ';
			$msg.=htmlentities($namespace);	
			die($msg);
		}
	}
	function getMethod($methodRaw=false){
		$method=$_SERVER['REQUEST_METHOD'];
		if($this->methodRaw or $methodRaw){
			return $method;
		}else{
			if($method=='POST') {
				return 'POST';
			}else{
				return 'GET';
			}
		}
	}	
	function load($filename){
		if(file_exists($filename)){
			$this->routes=require $filename;
		}else{
			die('file '.htmlentities($filename).' not found');
		}
		if(is_array($this->routes)){
			if(isset($this->routes[$this->segment(1)])){
				return $this->call($this->routes[$this->segment(1)]);
			}elseif(isset($this->routes['*'])){	
				return $this->call($this->routes['*']);
			}elseif(isset($this->routes['404'])){	
				http_response_code(404);			
				return $this->call($this->routes['404']);
			}else{
				http_response_code(404);
				die('404 not found');
			}
		}else{	
			die('invalid routes.php file');
		}
	}
	function setMethodRaw($methodRaw){
		$this->methodRaw=$methodRaw;
	}	
	function segment($segment=null){
		// 1) pega os dados do header
		$host=$_SERVER['HTTP_HOST'];
		$uri=$_SERVER["REQUEST_URI"];

		// 2) pega os diretórios
		$uri=explode('?',$uri)[0];

		// 3) transforma os diretórios em array
		if($uri=='/'){
			$arr[1]='/';
		}else{
			$arr=explode('/',$uri);
			$arr=array_filter($arr);	
			$arr=array_values($arr);
		}

		// 4) remove o primeiro diretório no localhost
		if($host=='localhost'){
			unset($arr[0]);
		}

		// remove o public
		if($host=='localhost' and @$arr[1]=='public'){
			unset($arr[1]);	
		}

		if(count($arr)=='0'){
			$arr[]='/';
		}	

		// 5) normaliza o array de saída
		$i=1;
		$out=null;
		foreach ($arr as $key => $value) {
			$out[$i]=$value;
			$i++;
		}
		$arr=$out;

		// 6) retorna o array ou o diretório específicado
		if(is_null($segment)){
			return $arr;
		}elseif(isset($arr[$segment])){
			return $arr[$segment];
		}else{
			return false;
		}
	}	
}