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
    Hotels Orders
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
    <div class="card" onclick="location.href='/hotel_dbi/orders.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>



    
    <div style = "margin-left: 200px;">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Orders</h1>
        <form action="../../script/add_orders_script.php" method="POST">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer:</label>
                <select class="form-select" name="customer_id" id="customer_id" required>
                <?php        
                    
                    $customer_query = "SELECT customer_id, name, lastname FROM Customers";
                    $customer_result = mysqli_query($conn, $customer_query);
            
                    
                    if ($customer_result) {
                        
                        while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                            echo "<option value='" . $customer_row['customer_id'] . "'>" . $customer_row['name'] . " " . $customer_row['lastname'] . "</option>";
                        }
                        
                        mysqli_free_result($customer_result);
                    } else {
                        
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="rooms_id" class="form-label">Room:</label>
                <select class="form-select" name="rooms_id" id="rooms_id" required>
                <?php        
                    
                    $room_query = "SELECT rooms_id FROM Rooms";
                    $room_result = mysqli_query($conn, $room_query);
            
                    
                    if ($room_result) {
                        
                        while ($room_row = mysqli_fetch_assoc($room_result)) {
                            echo "<option value='" . $room_row['rooms_id'] . "'>" . $room_row['rooms_id'] . "</option>";
                        }
                        
                        mysqli_free_result($room_result);
                    } else {
                        
                        echo "Помилка запиту: " . mysqli_error($conn);
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="bill_sum" class="form-label">Bill sum:</label>
                <input type="text" class="form-control" name="bill_sum" id="bill_sum" required>
            </div>
            <div class="mb-3">
                <label for="review_id" class="form-label">Review:</label>
                <select class="form-select" name="review_id" id="review_id" required>
                    <?php
                        
                        $review_query = "SELECT review_id, review_text FROM Reviews;";
                        $review_result = mysqli_query($conn, $review_query);
                    
                        
                        if ($review_result) {
                            
                            while ($review_row = mysqli_fetch_assoc($review_result)) {
                                echo "<option value='" . $review_row['review_id'] . "'>" . $review_row['review_text'] . "</option>";
                            }
                            
                            mysqli_free_result($review_result);
                        } else {
                            
                            echo "Помилка запиту: " . mysqli_error($conn);
                        }
                    
                        
                        mysqli_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_children" name="is_children">
                Children
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_pets" name="is_pets">
                Pets
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Add Orders</button>
        </form>
    </div>

<?php endblock() ?>