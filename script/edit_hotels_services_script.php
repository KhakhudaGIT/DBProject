<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $hotel_id = $_POST['hotel_id'];
    $service_id = $_POST['service_id'];

    
    if (empty($errors)) {
        
         $sql = "UPDATE Hotels_services 
        SET hotel_id = '$hotel_id',
			service_id = '$service_id'
		WHERE hotels_services_id = $id;";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/hotels_services/hotels_services_show.php");
    }
