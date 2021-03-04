<?php
session_start();
require_once 'connect.php';
require_once 'functions.php';

$email = $_POST['email'];
$password = $_POST ['password'];
$user_name = $_POST ['user_name'];
$role = $_POST['role'];
$job_title = $_POST ['job_title'];
$phone = $_POST ['phone'];
$address = $_POST ['address'];
$status = $_POST ['list'];
$telegram = $_POST ['telegram'];
$instagram = $_POST ['instagram'];
$vk = $_POST ['vk'];
$fileTmpName = $_FILES['img']['tmp_name'];
$fileName = $_FILES['img']['name'];

if (isset($email) && ($password)){
	if(get_user_by_email($email,  $pdo)){
		set_flash_message('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
		$path = 'create_user.php';
		redirect_to($path);
	} else {
		if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES)){
			$id = add_user($email, $password);
			edit_info($user_name, $job_title, $phone, $address, $pdo, $id);
			set_status($id, $status, $pdo);
			set_role($id, $role, $pdo);
			upload_avatar($fileTmpName, $fileName, $id, $pdo);
			add_social_links($telegram, $instagram, $vk, $id);
			set_flash_message('success', 'Пользователь добавлен');
			$path = 'users.php';
			redirect_to($path);
		}
	}	
}
