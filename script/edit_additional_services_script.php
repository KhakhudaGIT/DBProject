<?php
	require_once 'connect.php';
	
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

	
    if (empty($errors)) {
        
        $sql = "UPDATE Additional_services SET name = '$name', price = '$price' WHERE add_services_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/additional_services/additional_services_show.php");
    }
