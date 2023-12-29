<?php
	session_start();
	
	require_once 'connect.php';
	
	$errors = array();
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$price = filter_var(trim($_POST['price']), FILTER_SANITIZE_STRING);

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
        header('Location: /hotel_dbi/additional_services/additional_services_add.php');
        exit();
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $price = mysqli_real_escape_string($conn, $price);
        
        $sql = "INSERT INTO Additional_services (name, price) 
            VALUES ('$name', '$price')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/additional_services/additional_services_show.php");
        exit();
    }