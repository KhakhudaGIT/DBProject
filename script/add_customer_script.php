<?php
	session_start();
	
	require_once 'connect.php';
	$errors = array();
	
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$number = filter_var(trim($_POST['number']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$birthday = filter_var(trim($_POST['birthday']), FILTER_SANITIZE_STRING);
    $middle_name = filter_var(trim($_POST['middle_name']), FILTER_SANITIZE_STRING);
	$lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);

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
	if (strlen($email) >= 50) {
        addError('emailError', 'E-mail length should be less than 50 characters.');
    }
	if (strlen($name) >= 50) {
        addError('middleNameError', 'Middle name length should be less than 50 characters.');
    }
	if (strlen($name) >= 50) {
        addError('lastNameError', 'Lastname length should be less than 50 characters.');
    }
	
	
	
	
	if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/customers/customer_add.php');
        exit();
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $number = mysqli_real_escape_string($conn, $number);
		$email = mysqli_real_escape_string($conn, $email);
		$birthday = mysqli_real_escape_string($conn, $birthday);
		$middle_name = mysqli_real_escape_string($conn, $middle_name);
		$lastname = mysqli_real_escape_string($conn, $lastname);
        
        $sql = "INSERT INTO Customers (name, number, email, birthday, middle_name, lastname) 
        VALUES ('$name', '$number', '$email', '$birthday', '$middle_name', '$lastname')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/customers/customer_show.php");
        exit();
    }