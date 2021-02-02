<?php
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
	//вернет ID последнего созданного пользователя
	//первый вариант
	$id = $pdo->lastInsertId();
	//второй вариант
	//$user = $stmt->fetch(PDO::FETCH_ASSOC);
	// return $user['id'];
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
	if (isset ($_SESSION [$key])) {
		
		echo '<div class="alert alert-'. $key .' text-dark" role="alert">'. $_SESSION[$key] .'</div>';
		unset($_SESSION[$key]); 
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

/* авторизация пользователя
	string - $email
	string - $password
	Return value: boolean
*/
function login($email, $password, $pdo) {
	$query = "SELECT * FROM users WHERE email = :email AND password = :password";
	$stmt = $pdo->prepare($query);
	$stmt -> execute([
		email => $email,
		password => $password
	]);
	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (!$user){
		set_flash_message('danger', 'Неверный email или пароль');
		return false;
	} else {
		$SESSION['user_id'] = $user['id'];
		return true;
	}
};	
