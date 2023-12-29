<?php
	session_start();
	
	require_once 'connect.php';
	
	$errors = array();
	
	$hotels_services_id = filter_var(trim($_POST['hotels_services_id']), FILTER_SANITIZE_STRING);
	$hotel_id = filter_var(trim($_POST['hotel_id']), FILTER_SANITIZE_STRING);
	$service_id = filter_var(trim($_POST['service_id']), FILTER_SANITIZE_STRING);

	if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/hotels_services/hotels_services_add.php');
        exit();
    } else {
        $hotels_services_id = mysqli_real_escape_string($conn, $hotels_services_id);
		$hotel_id = mysqli_real_escape_string($conn, $hotel_id);
		$service_id = mysqli_real_escape_string($conn, $service_id);

        $sql = "INSERT INTO Hotels_services (hotels_services_id, hotel_id, service_id) 
            VALUES ('$hotels_services_id', '$hotel_id', '$service_id')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/hotels_services/hotels_services_show.php");
    }