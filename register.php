<?php
session_start();

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
/* поиск пользователя в БД по эл. адресу
	string - $email
	Return value: array 
*/ 
function get_user_by_email($email,  $pdo) {
	$guery = "SELECT * FROM users WHERE email=:email";
	$stmt = $pdo->prepare($guery);
	$stmt->execute(['email' => $email]);
	$task = $stmt->fetch()['email'];
	return $task;	
};

/* добавить пользователя в БД
	string -$email
	string - $password
	Return value: int (user_id)
*/
function add_user($email, $password, $pdo) {
	$query = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $pdo->prepare($query);
	$stmt ->execute([
		'email' => $email,
		'password' => $password
	]);
};

/* подготовка флеш сообщения
	string - $key
	string - $message (значение, текст сообщения)
	Return value: null
*/
function set_flash_message($key, $message) {
	$_SESSION[$key] = $message;

};

/* вывести флеш сообщение
	string - $key
	Return value: null
*/	
function display_flash_message($key) {
	if (isset ($_SESSION ['$key'])) {
		
		echo '<div class="alert alert-'. $key. 'text-dark" role="alert">'.$_SESSION [$message].'</div>';
		unset($_SESSION['$key']); 
	}
};

/* перенаправить на другую страницу
	string - $path
	Return value: null
*/
function redirect_to($path) {
	header("Location: ".$path);
	exit();
};	
