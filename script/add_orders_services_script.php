<?php
	session_start();
	
	require_once 'connect.php';
	
	$errors = array();
	
	$order_id = filter_var(trim($_POST['order_id']), FILTER_SANITIZE_STRING);
	$add_services_id = filter_var(trim($_POST['add_services_id']), FILTER_SANITIZE_STRING);

	if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/orders_services/orders_services_add.php');
        exit();
    } else {
		$order_id = mysqli_real_escape_string($conn, $order_id);
		$add_service_id = mysqli_real_escape_string($conn, $add_service_id);

        $sql = "INSERT INTO Order_services (order_id, add_services_id) 
            VALUES ('$order_id', '$add_services_id')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/orders_services/orders_services_show.php");
    }