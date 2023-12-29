<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $summa = $_POST['summa'];
    $room_id = $_POST['rooms_id'];
	$review_id = $_POST['review_id'];
	$is_children = isset($_POST['is_children']) ? 1 : 0; 
    $is_pets = isset($_POST['is_pets']) ? 1 : 0; 




    
    if (empty($errors)) {
        
         $sql = "UPDATE Orders 
        SET customer_id = '$customer_id',
            bill_sum = '$summa',
            rooms_id = '$room_id',
            review_id = '$review_id',
            is_children = '$is_children',
            is_pets = '$is_pets'
        WHERE order_id = $id";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/orders/orders_show.php");
    }
