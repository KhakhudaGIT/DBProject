<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $order_id = $_POST['order_id'];
    $add_services_id = $_POST['add_services_id'];

    
    if (empty($errors)) {
        
         $sql = "UPDATE Order_services 
        SET order_id = '$order_id',
			add_services_id = '$add_services_id'
		WHERE order_services_id = $id;";

        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/orders_services/orders_services_show.php");
    }
