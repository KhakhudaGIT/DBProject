<?php include '../../main_base.php'?>
<style>
    body {
        
    }

    .mb-3 {
        margin-bottom: 10px;
    }

    .card {
        width: 10px;
        margin: 2px;
        padding: 15px;
        text-align: center;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: transparent;
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
        max-width: 200px;
    }

    
    h1 {
        white-space: nowrap; 
    }
</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    Hotels hotels
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

<style>
    .container {
        max-width: 300px; 
        margin: 0 auto; 
        padding: 500px; 
    }

    .form-control {
        max-width: 200px; 
    }
</style>

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/hotel_dbi/hotels.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <div class="container mt-3">
	 <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Hotel</h1>
        <form action="../../script/add_hotel_script.php" method="POST" style = "margin-left: 230px;">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
                <?php displayErrors($errors, 'nameError'); ?>
            </div>
			<div class="mb-3">
                <label for="locality" class="form-label">Locality:</label>
                <input type="text" class="form-control" name="locality" id="locality" required>
                <?php displayErrors($errors, 'localityError'); ?>
            </div>
            <div class="mb-3">
                <label for="adress" class="form-label">Adress:</label>
                <input type="text" class="form-control" name="adress" id="adress" required>
                <?php displayErrors($errors, 'addressError'); ?>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity:</label>
                <input type="text" class="form-control" name="capacity" id="capacity" required>
            </div>
			<div class="mb-3">
                <label for="rang" class="form-label">Rank:</label>
                <input type="text" class="form-control" name="rang" id="rang" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Hotel</button>
        </form>
    </div>

<?php endblock() ?>