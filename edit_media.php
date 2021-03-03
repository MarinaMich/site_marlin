<?php
session_start();
require_once 'functions.php';
require_once 'connect.php';

$id = $_SESSION['user_profil']['id'];
$fileTmpName = $_FILES['img']['tmp_name'];
$fileName = $_FILES['img']['name'];
upload_avatar($fileTmpName, $fileName, $id, $pdo);
set_flash_message('success', 'Профиль успешно обновлен');
$path = 'page_profile.php?id='.$id;
redirect_to($path);