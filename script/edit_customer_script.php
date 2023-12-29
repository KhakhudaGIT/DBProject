<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $middle_name = $_POST['middle_name'];
    $lastname = $_POST['lastname'];

    
    if (empty($errors)) {
        
        $sql = "UPDATE Customers SET name = '$name', 
            number = '$number',
            email = '$email',
            birthday = '$birthday',
            middle_name = '$middle_name',
            lastname = '$lastname' WHERE customer_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/customers/customer_show.php");
    }
