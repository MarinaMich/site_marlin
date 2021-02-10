<?php
/* поиск пользователя в БД по эл. адресу
	string - $email
	Return value: array 
*/ 
function get_user_by_email($email,  $pdo) {
	$guery = "SELECT * FROM users WHERE email=:email";
	$stmt = $pdo->prepare($guery);
	$stmt->execute(['email' => $email]);
	$task = $stmt->fetch(PDO::FETCH_ASSOC);
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
		'password' => password_hash($password, PASSWORD_DEFAULT)
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
	$query = "SELECT * FROM users WHERE email = :email";
	$stmt = $pdo->prepare($query);
	$stmt->execute([
		'email'=> $email
	]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$pass = password_verify($password, $user['password']);
	
	if (!empty($user) && $pass) {
		$SESSION['user_id'] = $user['id'];
		return true;
	} 
	else {
		set_flash_message('danger', 'Неверный email или пароль');
	}	
};	

/* Проверяет,авторизирован пользователь или нет
	Возвращает true, если авторизирован, если нет- false
	Return value: boolean
*/
function is_logged_in(){
	if (isset($_SESSION['user_id'])){
		return $_SESSION['user_id'];
	} else return false;
}

/* Проверка прав администратора
	1 - администратор, 2 - пользователь
	Return value: boolean
*/
function is_admin($id, $pdo){
	
	$query = "SELECT * FROM users WHERE id = :id";
	$stmt = $pdo->prepare($query);
	$stmt->execute([
		'id'=> $id,
	]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	//return $user;
	if ($user['role'] == '1'){
		return true;
	} else return false;
}

/* Вывод всех пользователей
*/	
function get_users($pdo){
	$query = "SELECT * FROM users";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
