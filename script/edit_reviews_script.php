<?php
	require_once 'connect.php';
	
    $id = $_POST['id'];
    $review_text = $_POST['review_text'];
    $rate = $_POST['rate'];

	
    if (empty($errors)) {
        
        $sql = "UPDATE Reviews SET review_text = '$review_text', rate = '$rate' WHERE review_id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/reviews/reviews_show.php");
    }
