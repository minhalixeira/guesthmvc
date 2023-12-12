<?php
namespace hmvc\home;
use hmvc\messages\c as Messages;
class c{
	function GET(){
		$title='Guest HMVC';
		$Messages=new Messages();
		$messages=$Messages->readAll();
		require HMVC.'/home/view/head.php';
		require HMVC.'/home/view/home.php';
	}
}
