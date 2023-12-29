<?php

session_start();

	require_once 'connect.php';
    $errors = array();

    $review_text = filter_var(trim($_POST['review_text']), FILTER_SANITIZE_STRING);
    $rate = filter_var(trim($_POST['rate']), FILTER_SANITIZE_STRING);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: /hotel_dbi/reviews/reviews_add.php');
        exit();
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $adress = mysqli_real_escape_string($conn, $adress);
        
        $sql = "INSERT INTO Reviews (review_text, rate) 
        VALUES ('$review_text', '$rate')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/reviews/reviews_show.php");
        exit();
    }

    if (empty($errors)) {
        $sql = "INSERT INTO Reviews (review_text, rate) 
        VALUES ('$review_text', '$rate')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("Location: /hotel_dbi/reviews/reviews_show.php");
    }
