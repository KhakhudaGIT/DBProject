<?php
	require_once 'connect.php';
	session_start();
	$login = trim($_POST['loginReg']);
	$email = trim($_POST['emailReg']);
	$passwd = trim($_POST['passwordReg']);

	$errors = array();
	
	$sql_uniq_email = "SELECT email FROM Users WHERE email = '$email'";
	$result_uniq_email = mysqli_query($conn, $sql_uniq_email);


	function addError($field, $errorMessage) {
    	global $errors;
    	if (!isset($errors[$field])) {
        	$errors[$field] = array();
    	}
    	$errors[$field][] = $errorMessage;
	}



	
	if (empty($login)) {
    	addError('loginRegEmpty', 'Поле LOGIN не може бути порожнім');
	} elseif (strlen($login) <= 3) {
		addError('loginRegLenght', 'Поле LOGIN не може бути менше 3 символів');
	}elseif (strlen($login) >= 10) {
		addError('loginRegLenght', 'Поле LOGIN не може бути більше 10 символів');
	}

	
	
	if (empty($email)){
    	addError('emailRegEmpty', 'Поле Email не повинно бути порожнім');
	} elseif (mysqli_num_rows($result_uniq_email) > 0){
    	addError('emailRegIS', 'Email зайнятий');
	}

	
	if (empty($passwd)){
    	addError('passwdRegEmpty', 'Поле PASSWORD не повинно бути порожнім');
	} elseif (strlen($passwd) <= 6) {
		addError('passwdRegLenght', 'Поле PASSWORD не повинно бути менше 6 символів');
	}



	if (!empty($errors)){
    	$_SESSION['errors'] = $errors;
    	header('Location: ../register_page.php');
    	exit();
	} else {
		$passwd_chash = md5($passwd);
		$sql = "INSERT INTO Users (login, password, email) VALUES ('$login','$passwd_chash', '$email')";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header("Location: ../auth_page.php");
		exit();
	}