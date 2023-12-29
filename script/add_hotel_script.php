<?php

session_start();

	require_once 'connect.php';

    $errors = array();

	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $adress = filter_var(trim($_POST['adress']), FILTER_SANITIZE_STRING);
    $locality  = filter_var(trim($_POST['locality']), FILTER_SANITIZE_STRING);
    $capacity  = filter_var(trim($_POST['capacity']), FILTER_SANITIZE_STRING);
    $rang  = filter_var(trim($_POST['rang']), FILTER_SANITIZE_STRING);

    function addError($field, $errorMessage) {
        global $errors;
        if (!isset($errors[$field])) {
            $errors[$field] = array();
        }
        $errors[$field][] = $errorMessage;
    }

    if (strlen($name) >= 25) {
        addError('nameError', 'Name length should be less than 25 characters.');
    }

    if (strlen($adress) >= 50) {
        addError('addressError', 'Address length should be less than 50 characters.');
    }

    if (strlen($locality) >= 25) {
        addError('localityError', 'Locality length should be less than 25 characters.');
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/hotels/hotels_add.php');
        exit();
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $adress = mysqli_real_escape_string($conn, $adress);
        $locality = mysqli_real_escape_string($conn, $locality);
        $capacity = mysqli_real_escape_string($conn, $capacity);
        $rang = mysqli_real_escape_string($conn, $rang);

        
        $sql = "INSERT INTO Hotels (name, locality, adress, capacity, rang) 
        VALUES ('$name', '$locality', '$adress', '$capacity', '$rang')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/hotels/hotels_show.php");
        exit();
    }
