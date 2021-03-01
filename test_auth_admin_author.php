<?php
session_start();
require_once 'functions.php'; 
require_once 'connect.php';
//возвращает на страницу входа, если не пройдена аутентификация
if (!is_logged_in()){
    redirect_to('page_login.php');
}
//получаем id аутентифицированного пользователя
$id = is_logged_in();
//получаем id пользователя, чей профиль редактируем
$id_profil = $_GET['id'];
//проверяем админ или нет
//свой профиль или нет
if (!(is_admin($id, $pdo)) && !(is_author($id, $id_profil))){
    set_flash_message('danger', 'Можно редактировать только свой профиль');
    redirect_to('users.php');
}
$user_profil = get_user_by_id($id_profil, $pdo);
$_SESSION['user_profil'] = $user_profil;
