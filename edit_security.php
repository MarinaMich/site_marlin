<?php
session_start();
require_once 'functions.php';
require_once 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
//получаем id и email профеля, который редактируем
$id = $_SESSION['user_profil']['id'];
$email_profil = $_SESSION['user_profil']['email'];
//проверяем наличие пользователя с таким email в БД
$data = get_user_by_email($email, $pdo);

if (($data['email'] = $email_profil) || ($data === false)){

	edit_credentials($id, $email, $password, $pdo);

	set_flash_message('success', 'Профиль успешно обновлен');
	$path = 'page_profile.php?id='.$id;
	redirect_to($path);
} elseif (!empty($data)){
	set_flash_message('danger', 'Email занят!');
	$path = 'security.php?id='.$id;
	redirect_to($path);
}	