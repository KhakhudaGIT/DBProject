<?php include '../../main_base.php'?>
<style>
body{
    background: linear-gradient(to bottom right, #FCF5EC, #459cd6);
    height: 100vh;
}
.mb-3{
    margin-bottom:10px
}
.card {
    width: 330px;
    margin: 20px;
    
    text-align: center;
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
select{
    margin: 0;
    font: inherit;
    color: inherit;
    padding: 7px;
    border-radius: 5px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    margin-left: 10px;
}



</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    Hotels Services
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
        <div class="card" onclick="location.href='/hotel_dbi/services.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>
    
    <style>
    .container {
        max-width: 300px; 
        margin: 0 auto; 
        padding: 2px; 
    }

    .form-control {
        max-width: 200px; 
    }
</style>


    
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add New Services</h1>
        <form action="../../script/add_services_script.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
				<?php displayErrors($errors, 'nameError'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Add Services</button>
        </form>
    </div>

<?php endblock() ?>