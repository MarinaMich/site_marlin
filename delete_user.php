<?php
session_start();
require_once 'test_auth_admin_author.php'; 

$id = $_SESSION['user_profil']['id'];
delete($id, $pdo);
delete_image($id, $pdo);
set_flash_message('success', 'Пользователь удален');
if(is_admin($id, $pdo) === true){
	$path = 'users.php';
	redirect_to($path);
} elseif (is_author($id, $id_profil) === true) {
	logout();
	$path = 'page_register.php';
	redirect_to($path);
}