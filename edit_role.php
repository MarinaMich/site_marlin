<?php
session_start();
require_once 'functions.php';
require_once 'connect.php';

$role = $_POST['role_profil'];
//var_dump($status);
//получаем id профеля, который редактируем

$id = $_SESSION['user_profil']['id'];

if(isset($role)){
	set_role($id, $role, $pdo);
	set_flash_message('success', 'Профиль успешно обновлен');
	$path = 'page_profile.php?id='.$id;
	redirect_to($path);
}