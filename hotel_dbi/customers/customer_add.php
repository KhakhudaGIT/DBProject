<?php include '../../main_base.php'?>
<style>
body{
   
}
.mb-3{
    margin-bottom:10px
}
.card {
    width: 10px;
    margin: 2px;
    padding: 15px;
    text-align: center;
    border: 0px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
    background-color: transparent;
    border: none;
}
img {
    border: 2px solid #525a61;
    border-radius: 15px;
    padding: 5px;
}
.container {
        max-width: 3000px;
        margin: 0 auto;
        padding: 250px;
        height: 100vh;
 }

.form-control {
        max-width: 220px;
}

    
h1 {
        white-space: nowrap; 
}

</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    Hotels Customer
<?php endblock() ?>


<?php startblock('bodyPageMain') ?>
    <?php 
        require_once '../../script/connect.php';

        if (!isset($_SESSION['email'])) {
            header('Location: auth_page.php');
            exit();
        }
		
		$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
		unset($_SESSION['errors']);

		function displayErrors($errors, $field) {
			if (isset($errors[$field]) && is_array($errors[$field])) {
				foreach ($errors[$field] as $error) {
					echo '<div class="alert alert-danger custom-alert_register" role="alert"><p>' . $error . '</p></div>';
				}
			}
		}
    ?>

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/hotel_dbi/customers.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>



    
    <div class="container mt-3">
        <h1 class="mt-5" style="text-align: center; margin-top: 10px;">Add new Customer</h1>
        <form action="../../script/add_customer_script.php" method="POST" style = "margin-left: 230px;">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
				<?php displayErrors($errors, 'nameError'); ?>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number:</label>
                <input type="text" class="form-control" name="number" id="number" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
				<?php displayErrors($errors, 'emailError'); ?>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday:</label>
                <input type="date" class="form-control" name="birthday" id="birthday" required>
            </div>
            <div class="mb-3">
                <label for="middle_name" class="form-label">Middle name:</label>
                <input type="text" class="form-control" name="middle_name" id="middle_name" required>
				<?php displayErrors($errors, 'middleNameError'); ?>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name:</label>
                <input type="text" class="form-control" name="lastname" id="lastname" required>
				<?php displayErrors($errors, 'lastNameError'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>


<?php endblock() ?>