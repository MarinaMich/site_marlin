<?php
require_once 'connect.php';
require_once 'functions.php'; 
//возвращает на страницу входа, если не пройдена аутентификация
if (!is_logged_in()){
	redirect_to('page_login.php');
}
//получаем id аутентифицированного пользователя
$id = (int)is_logged_in();
//проверяем админ или нет
$role = is_admin($id, $pdo);
//вывод всех пользователей
$users = get_users($pdo);
