<?php
session_start();
include 'functions.php'; 

$email = $_POST['email'];
$password = sha1($_POST ['password']);

$pdo = new PDO("mysql:host=localhost;dbname=site_marlin;", "root", "mysql");

if (isset($email) && ($password)){

	if (get_user_by_email($email,  $pdo)){
		set_flash_message('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
		$path = 'page_register.php';
		redirect_to($path);
		
	} else {
		add_user($email, $password, $pdo);
		set_flash_message('success', 'Регистрация успешна');
		$path = 'page_login.php';
		redirect_to($path);
	}
}	
