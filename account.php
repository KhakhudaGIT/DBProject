<?php include 'main_base.php'?>
<?php startblock('link') ?>
    <link rel="stylesheet" href="css/style_acc.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    Hotels Account
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>
    <?php 
		require_once 'script/connect.php';
		if (!isset($_SESSION['email'])) {
        	header('Location: auth_page.php');
        	exit();
    	}

		$email = $_SESSION['email'];
		$sql = "SELECT login, email FROM Users WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
		    
		    $row = mysqli_fetch_assoc($result);
		    $login = $row['login'];
		    $email = $row['email'];
		} else {
		    echo "Інформація про користувача не знайдена";
		}
	
		mysqli_close($conn);


        function logout() {
            session_unset();
            session_destroy();
            header('Location: auth_page.php');
            exit();
        }

	?>
	<div class="user-info">
    <div style = " border-bottom: 1px solid #f0f0f0; font-weight: 700;"> <h1>Данні користувача</h1></div>
        <p style = "margin-top: 20px;">Логін: <?php echo $login; ?></p>
        <p>Email: <?php echo $email; ?></p>
    </div>
<div class= "knopki">
    <div class="logout-button">
        <form method="POST">
            <input type="submit" name="logout" value="Вихід">			
        </form>
    </div>
	 <div class="next-button">             
			<a href="main_page.php" class="btn btn-success">Далі</a>
     </div>
</div>
	
	
	
	

    <?php
        if (isset($_POST['logout'])) {
            logout();
        }
    ?>


<?php endblock() ?>