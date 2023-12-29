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
    Hotels Order services
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
    <div class="card" onclick="location.href='/hotel_dbi/orders_services.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>



    
    <div style = "margin-left: 200px;">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Order service</h1>
        <form action="../../script/add_orders_services_script.php" method="POST">
            <div class="mb-3">
                <label for="order_id" class="form-label">Order:</label>
                <select class="form-select" name="order_id" id="order_id" required>
                <?php        
                    
                    $order_query = "SELECT order_id FROM Orders";
                    $order_result = mysqli_query($conn, $order_query);
            
                    
                    if ($order_result) {
                        
                        while ($order_row = mysqli_fetch_assoc($order_result)) {
                            echo "<option value='" . $order_row['order_id'] . "'>" . $order_row['order_id'] . "</option>";
                        }
                        
                        mysqli_free_result($order_result);
                    } else {
                        
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="add_services_id" class="form-label">Additional service:</label>
                <select class="form-select" name="add_services_id" id="add_services_id" required>
                <?php        
                    
                    $service_query = "SELECT add_services_id, name FROM Additional_services";
                    $service_result = mysqli_query($conn, $service_query);
            
                    
                    if ($service_result) {
                        
                        while ($service_row = mysqli_fetch_assoc($service_result)) {
                            echo "<option value='" . $service_row['add_services_id'] . "'>" . $service_row['name'] . "</option>";
                        }
                        
                        mysqli_free_result($service_result);
                    } else {
                        
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Order service</button>
        </form>
    </div>

<?php endblock() ?>