<?php
    require_once 'connect.php';
	
    $id = $_GET['id'];

    $sql = "DELETE FROM Hotels_services WHERE hotels_services_id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);

        header("Location: /hotel_dbi/hotels_services/hotels_services_show.php");
    } else {
        echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
    }
