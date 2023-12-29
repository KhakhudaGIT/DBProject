<?php
    require_once 'connect.php';
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $locality = $_POST['locality'];
    $adress = $_POST['adress'];
	$capacity = $_POST['capacity'];
	$rang = $_POST['rang'];
    
    if (empty($errors)) {
        
        $sql = "UPDATE Hotels SET name = '$name', 
            locality = '$locality',
            adress = '$adress',
			capacity = '$capacity',
			rang = '$rang'
			WHERE hotel_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/hotels/hotels_show.php");
    }
