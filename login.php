<?php
session_start();

require_once 'connect.php';
require_once 'functions.php';

$email = $_POST['email'];
$password = $_POST ['password'];

if (!empty($email) && ($password)){
	if (login($email, $password, $pdo) === true){
		$path = 'users.php';
	redirect_to($path);
	} else {
		$path = 'page_login.php';
		redirect_to($path);
	}
} 
