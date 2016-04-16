<?php 


spl_autoload_register(function($class){
	if (is_file("controller/" . $class . ".php")){
		require("controller/" . $class . ".php");
	} elseif(is_file("model/" . $class . ".php")) {
		require("model/" . $class . ".php");
	}
});

require 'App.php'; 
require 'Router.php';
session_start();

$user = NULL;
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
}


$db = new PDO('mysql:host=localhost;', 'root','');
if($db->exec("CREATE DATABASE `TEST`")){
	$db->exec("USE `TEST`");

	$db->exec("CREATE TABLE IF NOT EXISTS `users` (
				`id` int(11) PRIMARY KEY AUTO_INCREMENT,
				`email` char(60) UNIQUE KEY,
				`login` char(60) UNIQUE KEY,
				`real_name` char(60) DEFAULT NULL,
				`password` char(60) DEFAULT NULL,
				`birthday` datetime DEFAULT NULL,
				`country` int(11) DEFAULT NULL,
				`register_date` datetime
				)
	");

	$db->exec("CREATE TABLE IF NOT EXISTS `countries` (
				`id` int(11) PRIMARY KEY AUTO_INCREMENT,
				`name` char(60) UNIQUE KEY
				)
	");

	$db->exec("INSERT INTO `countries` VALUES (NULL, 'Ukraine'),(NULL, 'USA'),(NULL, 'Poland'),(NULL, 'Denmark')");
}else{
	$db->exec("USE `TEST`");
}


