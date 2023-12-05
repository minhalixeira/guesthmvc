<?php
require 'cfg.php';
if($routes->segment(1)=='/'){
	header('Location: '.$_ENV['SITE_URL']);
	die();
}