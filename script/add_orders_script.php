<?php
	session_start();
	
	require_once 'connect.php';
	
	$errors = array();
	
	$customer_id = filter_var(trim($_POST['customer_id']), FILTER_SANITIZE_STRING);
	$summa = filter_var(trim($_POST['summa']), FILTER_SANITIZE_STRING);
	$room_id = filter_var(trim($_POST['room_id']), FILTER_SANITIZE_STRING);
	$review_id = filter_var(trim($_POST['review_id']), FILTER_SANITIZE_STRING);
	$is_children = isset($_POST['is_children']) ? 1 : 0;
    $is_pets = isset($_POST['is_pets']) ? 1 : 0;

	if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/services/services_add.php');
        exit();
    } else {
        $customer_id = mysqli_real_escape_string($conn, $customer_id);
		$summa = mysqli_real_escape_string($conn, $summa);
		$room_id = mysqli_real_escape_string($conn, $room_id);
		$review_id = mysqli_real_escape_string($conn, $review_id);
		$is_children = mysqli_real_escape_string($conn, $is_children);
		$is_pets = mysqli_real_escape_string($conn, $is_pets);

        $sql = "INSERT INTO Orders (customer_id, bill_sum, rooms_id, review_id, is_children, is_pets) 
            VALUES ('$customer_id', '$summa', '$room_id', '$review_id', '$is_children', '$is_pets')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/orders/orders_show.php");
    }