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
function add_user($email, $password) {
	$pdo = new PDO(
    	"mysql:host=localhost;dbname=site_marlin;",
    	"root",
    	"mysql"
    	//,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
	$query = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $pdo->prepare($query);
	//$pdo->beginTransaction();
	$stmt ->execute([
		'email' => $email,
		'password' => password_hash($password, PASSWORD_DEFAULT)
	]);
	
	return $id = (int)$pdo->lastInsertId();
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
		'email'=> $email,
		//'password' => $password
	]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$pass = password_verify($password, $user['password']);
	//return $pass;
	//(password_verify($password, $user->password)===true)
	if (!empty($user) && $pass) {
		$_SESSION['user_id'] = $user['id'];
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
	Return value: array
*/	
function get_users($pdo){
	//$query = "SELECT * FROM users";
	//$stmt = $pdo->prepare($query);
	//$stmt->execute();
	//return $stmt->fetchAll(PDO::FETCH_ASSOC);

	$query = "SELECT * FROM users as u JOIN sozial_links as s_l ON u.id = s_l.user_id";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* Добавление и редактирование общей информации пользователя
	string - $username
	string - $job_title
	string - $phone
	string - $address
	Return value: boolean
*/
function edit_info($user_name, $job_title, $phone, $address, $pdo, $id){
	$query = "UPDATE users SET user_name = :user_name, job_title = :job_title, phone = :phone, address = :address WHERE id = :id";
	$stmt = $pdo->prepare($query);
	$stmt->execute([
		'user_name' => $user_name,
		'job_title' => $job_title,
		'phone' => $phone,
		'address' => $address,
		'id' => $id
	]);
}

/* Установить статус
	string - $status
	Return value: null
*/
function set_status($status, $pdo, $id){
	$query = "UPDATE users SET status = :status WHERE id = :id";
	$stmt = $pdo->prepare($query);
	$stmt->execute([
		'status' => $status,
		'id' => $id
	]);
}

/* Загрузить аватар
	array - $image
	Return value: null| string (path)
*/
function upload_avatar($fileTmpName, $fileName, $id, $pdo){
	foreach ($_FILES as $file) {
		$fileType = explode("/", $file['type'])[0];
	            
		if ($file['error'] != 0) {
	        set_flash_message('link', "Произошла ошибка: " . $file['error'] . "!");
	        $path = 'create_user.php';
			redirect_to($path);
		} elseif ($fileType != "image") {
	        set_flash_message('link', "Неверный тип файла: " . $file['name'] . "!");
	        $path = 'create_user.php';
			redirect_to($path);
		} elseif ($file['size'] > 3000) {
	        set_flash_message('link', "Слишком большой размер файла: " . $file['size'] . "! Не более 2.8 Кб!");
	        $path = 'create_user.php';
			redirect_to($path);
		} else {
			$imgDir = "img/demo/avatars/";
			$avatar = $imgDir . $fileName;
			move_uploaded_file($fileTmpName, $avatar);
			if (move_uploaded_file($fileTmpName, $avatar)!== null){
				$query = "UPDATE users SET avatar = :avatar WHERE id = :id";
				$stmt = $pdo->prepare($query);
				$stmt->execute([
					'avatar' => $avatar,
					'id' => $id
				]);
			}
		}	
	}	
}

/* Добавить ссылки на соцсети
	string - $telegram
	string - $instagram
	string - $vk
	Return value: null
*/
function add_social_links($telegram, $instagram, $vk, $id){
	$pdo = new PDO(
    	"mysql:host=localhost;dbname=site_marlin;",
    	"root",
    	"mysql"
    	//,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
	$query = "INSERT INTO sozial_links (user_id, telegram, instagram, vk) VALUES (:id, :telegram, :instagram, :vk)";
	$stmt = $pdo->prepare($query);
	$stmt->execute([
		'telegram' => $telegram, 
		'instagram' => $instagram, 
		'vk' => $vk,
		'id' => $id
	]);
}