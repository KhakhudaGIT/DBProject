<?php
	session_start();
	
	require_once 'connect.php';
	
	$errors = array();
	
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	
	function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }
	
	if (strlen($name) >= 50) {
        addError('nameError', 'Name length should be less than 50 characters.');
    }
	
	if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/services/services_add.php');
        exit();
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        
        $sql = "INSERT INTO Services (name) 
            VALUES ('$name')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/services/services_show.php");
        exit();
    }
