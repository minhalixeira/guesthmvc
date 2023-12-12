<?php
namespace hmvc\home;
use hmvc\messages\MessagesController;
class HomeController{
	function GET(){
		$title='Guest HMVC';
		$MessagesController=new MessagesController();
		$messages=$MessagesController->readAll();
		require HMVC.'/home/view/head.php';
		require HMVC.'/home/view/home.php';
	}
}
