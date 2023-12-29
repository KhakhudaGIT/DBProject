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
    Hotels Orders services
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
        <div class="card" onclick="location.href='/hotel_dbi/orders_services.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        $id = $_GET['id'];
        
        
        $sql = "SELECT * FROM Order_services WHERE order_services_id = $id";
        $result = mysqli_query($conn, $sql);
        
        
        if ($result) {
            
            $orders_services_row = mysqli_fetch_assoc($result);
        
            
            $orders_query = "SELECT order_id FROM Orders";
            $orders_result = mysqli_query($conn, $orders_query);
			
			
            $service_query = "SELECT add_services_id, name FROM Additional_services";
            $service_result = mysqli_query($conn, $service_query);
			
            $orders_options = '';  
            while ($orders_row = mysqli_fetch_assoc($orders_result)) {
                $selected_orders = ($orders_row['order_id'] == $orders_services_row['order_id']) ? 'selected' : '';
                $orders_options .= "<option value='" . $orders_row['order_id'] . "'>" . $orders_row['order_id'] . "</option>";
            }

            $service_options = '';
            while ($service_row = mysqli_fetch_assoc($service_result)) {
                $selected_service = ($service_row['add_services_id'] == $orders_services_row['add_services_id']) ? 'selected' : '';
                $service_options .= "<option value='" . $service_row['add_services_id'] . "' $selected_service>" . $service_row['name'] . "</option>";
            }

            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Order service</h1>
                <form action='../../script/edit_orders_services_script.php' method='POST'>
					<div class='mb-3'>
                        <label for='order_id' class='form-label'>Order:</label>
                        <select class='form-select' name='order_id' required>
                            $orders_options
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='add_services_id' class='form-label'>Service:</label>
                        <select class='form-select' name='add_services_id' required>
                            $service_options
                        </select>
                    </div>
					
					<input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Order service</button>
                </form>
            </div>";

        } else {
            
            echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
        }
    ?>

<?php endblock() ?>
