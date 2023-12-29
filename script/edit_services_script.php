<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $name = $_POST['name'];

    
    if (empty($errors)) {
        
        $sql = "UPDATE Services 
                SET name = '$name'
                WHERE service_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/services/services_show.php");
    }
?>