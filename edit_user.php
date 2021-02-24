<?php
session_start();
require_once 'functions.php';
require_once 'connect.php';
$user_name = $_POST['user_name'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$id = $_SESSION['user_profil']['id'];

edit_info($user_name, $job_title, $phone, $address, $pdo, $id);
set_flash_message('success', 'Профиль успешно обновлен');
redirect_to('users.php');