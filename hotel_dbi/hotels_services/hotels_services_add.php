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
    Hotels Hotels services
<?php endblock() ?>


<?php startblock('bodyPageMain') ?>
    <?php 
        require_once '../../script/connect.php';

        if (!isset($_SESSION['email'])) {
            header('Location: auth_page.php');
            exit();
        }
    ?>

<div class="col-md-4">
    <div class="card" onclick="location.href='/hotel_dbi/hotels_services.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>



    
    <div style = "margin-left: 200px;">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Hotel service</h1>
        <form action="../../script/add_hotels_services_script.php" method="POST">
            <div class="mb-3">
                <label for="hotel_id" class="form-label">Hotel:</label>
                <select class="form-select" name="hotel_id" id="hotel_id" required>
                <?php        
                    
                    $hotel_query = "SELECT hotel_id, name FROM Hotels";
                    $hotel_result = mysqli_query($conn, $hotel_query);
            
                    
                    if ($hotel_result) {
                        
                        while ($hotel_row = mysqli_fetch_assoc($hotel_result)) {
                            echo "<option value='" . $hotel_row['hotel_id'] . "'>" . $hotel_row['name'] . "</option>";
                        }
                        
                        mysqli_free_result($hotel_result);
                    } else {
                        
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="service_id" class="form-label">Service:</label>
                <select class="form-select" name="service_id" id="service_id" required>
                <?php        
                    
                    $service_query = "SELECT service_id, name FROM Services";
                    $service_result = mysqli_query($conn, $service_query);
            
                    
                    if ($service_result) {
                        
                        while ($service_row = mysqli_fetch_assoc($service_result)) {
                            echo "<option value='" . $service_row['service_id'] . "'>" . $service_row['name'] . "</option>";
                        }
                        
                        mysqli_free_result($service_result);
                    } else {
                        
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Hotel service</button>
        </form>
    </div>

<?php endblock() ?>