<?php
    require_once 'connect.php';
    
    
    $id = $_POST['id'];
    $amount_people = $_POST['amount_people'];
    $reservation_date = $_POST['reservation_date'];
	$is_reserved = isset($_POST['is_reserved']) ? 1 : 0; 
	$hotel_id = $_POST['hotel_id'];
	$type_id = $_POST['type_id'];

    
    if (empty($errors)) {
        
        $sql = "UPDATE Rooms SET amount_people = '$amount_people', 
                reservation_date = '$reservation_date',
                is_reserved = '$is_reserved',
				hotel_id = '$hotel_id',
				type_id = '$type_id'
                WHERE rooms_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/rooms/rooms_show.php");
    }
