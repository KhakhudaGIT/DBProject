<?php
	require_once 'connect.php';
    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM Rooms WHERE rooms_id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        
        header("Location: /hotel_dbi/rooms/rooms_show.php");
    } else {
        echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
    }
