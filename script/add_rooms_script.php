<?php
	session_start();

    require_once 'connect.php';
	
	$errors = array();
	
	$amount_people = filter_var(trim($_POST['amount_people']), FILTER_SANITIZE_STRING);
	$reservation_date = filter_var(trim($_POST['reservation_date']), FILTER_SANITIZE_STRING);
    $is_reserved = $_POST['is_reserved'];
	$hotel_id = filter_var(trim($_POST['hotel_id']), FILTER_SANITIZE_STRING);
	$type_id = filter_var(trim($_POST['type_id']), FILTER_SANITIZE_STRING);
	
	if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/rooms/rooms_add.php');
        exit();
    } else {
        $amount_people = mysqli_real_escape_string($conn, $amount_people);
        $reservation_date = mysqli_real_escape_string($conn, $reservation_date);
		$is_reserved = mysqli_real_escape_string($conn, $is_reserved);
		$hotel_id = mysqli_real_escape_string($conn, $hotel_id);
		$type_id = mysqli_real_escape_string($conn, $type_id);
        
        $sql = "INSERT INTO Rooms (amount_people, reservation_date, is_reserved, hotel_id, type_id) 
            VALUES ('$amount_people', '$reservation_date', '$is_reserved', '$hotel_id', '$type_id')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/rooms/rooms_show.php");
        exit();
    }