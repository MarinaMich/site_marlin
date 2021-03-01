<?php
session_start();
require_once 'functions.php';
require_once 'connect.php';

$status = $_POST['list'];
//var_dump($status);
//получаем id профеля, который редактируем

$id = $_SESSION['user_profil']['id'];
if(isset($status)){
	set_status($id, $status, $pdo);
	set_flash_message('success', 'Профиль успешно обновлен');
	$path = 'page_profile.php?id='.$id;
	redirect_to($path);
}
