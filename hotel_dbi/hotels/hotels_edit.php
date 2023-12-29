<?php include '../../main_base.php'?>
<style>
body {
    font-family: Arial, sans-serif; 
    margin: 0;
    padding: 0;
}


.mb-3 {
    margin-bottom: 8px;
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
    border-radius: 12px;
    padding: 4px;
}

.container {
    max-width: 3000px;
    margin: 0 auto;
    padding-top: 50px; 
    height: 100vh;
    display: flex;
    flex-direction: column; 
    align-items: center;
    justify-content: center;
}


.form-control {
    max-width: 400px;
}

h1 {
    white-space: nowrap; 
    color: #333; 
    font-size: 24px; 
    margin: 0; 
    padding-bottom: 20px; 
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
    ?>

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/hotel_dbi/hotels.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    
        
        $sql = "SELECT * FROM Hotels WHERE hotel_id = $id";
        $result = mysqli_query($conn, $sql);
    
        
        if ($result) {
            
            $row = mysqli_fetch_assoc($result);
    
            
            $name = isset($row['name']) ? $row['name'] : '';
            $locality = isset($row['locality']) ? $row['locality'] : '';
            $adress = isset($row['adress']) ? $row['adress'] : '';
			$capacity = isset($row['capacity']) ? $row['capacity'] : '';
			$rang = isset($row['rang']) ? $row['rang'] : '';

            
            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Hotel</h1>
                <form action='../../script/edit_hotels_script.php' method='POST'>
                    <div class='mb-3'>
                        <label for='name' class='form-label'>Name:</label>
                        <input type='text' class='form-control' name='name' id='name' value='$name' required>
                    </div>
                    <div class='mb-3'>
                        <label for='locality' class='form-label'>Locality:</label>
                        <input type='text' class='form-control' name='locality' id='locality' value='$locality' required>
                    </div>
                    <div class='mb-3'>
                        <label for='adress' class='form-label'>Adress:</label>
                        <input type='text' class='form-control' name='adress' id='adress' value='$adress' required>
                    </div>
					<div class='mb-3'>
                        <label for='capacity' class='form-label'>Capacity:</label>
                        <input type='text' class='form-control' name='capacity' id='capacity' value='$capacity' required>
                    </div>
					<div class='mb-3'>
                        <label for='rang' class='form-label'>Rang:</label>
                        <input type='text' class='form-control' name='rang' id='rang' value='$rang' required>
                    </div>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Hotel</button>
                </form>
            </div>";
        } else {
            
            echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
        }
    } else {
        
        echo "Ошибка: Параметр id не был передан.";
    }
    ?>

<?php endblock() ?>


