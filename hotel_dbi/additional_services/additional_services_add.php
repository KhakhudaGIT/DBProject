<?php include '../../main_base.php'?>
<style>
body{
     justify-content: left;
}
.mb-3{
    margin-bottom:10px
}
.card {
    width: 100%; 
    margin: 2px;
    padding: 15px;    
    border: 0px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
    background-color: transparent;
    border: none;
}

img {
    max-width: 100%; 
    height: auto;    
    border: 2px solid #525a61;
    border-radius: 15px;
    padding: 5px;
}
.container {
        max-width: 3000px;
        margin: 0 auto;
        padding: 500px;
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
    Hotels Additional services
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

<div class="col-md-4">
    <div class="card" onclick="location.href='/hotel_dbi/additional_services.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>



    
    <div style = "margin-left: 200px;">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Additional services</h1>
        <form action="../../script/add_additional_services_script.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
				<?php displayErrors($errors, 'nameError'); ?>
            </div>
	    <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" name="price" id="price" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Additional services</button>
        </form>
    </div>

<?php endblock() ?>