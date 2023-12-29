<?php
    require_once 'connect.php';
	
    $id = $_GET['id'];

    $sql = "DELETE FROM Additional_services WHERE add_services_id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);

        header("Location: /hotel_dbi/additional_services/additional_services_show.php");
    } else {
        echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
    }
