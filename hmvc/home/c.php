<?php
namespace hmvc\home;
class c{
	function GET(){
		$title='Guest HMVC';
		require HMVC.'/home/view/head.php';
		require HMVC.'/home/view/home.php';
	}
}
