<?php
session_start();

require_once 'connect.php';
require_once 'functions.php';

$email = $_POST['email'];
$password = sha1($_POST ['password']);

//if (isset($email) && ($password)){
	if(login($email, $password, $pdo) === true){
	$path = 'users.php';
	redirect_to($path);
	}
//} 
