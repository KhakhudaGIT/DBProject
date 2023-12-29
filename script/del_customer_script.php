<?php
    require_once 'connect.php';
	
    $id = $_GET['id'];

    $sql = "DELETE FROM Customers WHERE customer_id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);

        header("Location: /hotel_dbi/customers/customer_show.php");
    } else 
        echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
    }
