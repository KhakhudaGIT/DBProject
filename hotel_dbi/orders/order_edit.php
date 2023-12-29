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
    width: 330px;
    margin: 20px;
    padding: 15px;
    text-align: center;
    border-radius: 10px;
    cursor: pointer;
}

img {
    border: 2px solid #525a61;
    border-radius: 15px;
    padding: 5px;
    max-width: 100%; 
}


.container {
    margin-top: 50px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
}

.form-label {
    font-weight: bold;
}

.form-select,
.form-control {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease-in-out;
}

.form-select:focus,
.form-control:focus {
    outline: none;
    border-color: #459cd6; 
}

.checkbox-label {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.checkbox-label input[type="checkbox"] {
    margin-right: 8px;
}

.btn-primary {
    display: block;
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #459cd6;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #87cefa;
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

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/hotel_dbi/orders.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        $id = $_GET['id'];
        
        
        $sql = "SELECT * FROM Orders WHERE order_id = $id";
        $result = mysqli_query($conn, $sql);
        
        
        if ($result) {
            
            $order_row = mysqli_fetch_assoc($result);
        
            
            $customer_query = "SELECT * FROM Customers";
            $customer_result = mysqli_query($conn, $customer_query);

            
            $review_query = "SELECT review_id, review_text FROM Reviews";
            $review_result = mysqli_query($conn, $review_query);
			
			
            $room_query = "SELECT rooms_id FROM Rooms";
            $room_result = mysqli_query($conn, $room_query);
			
            $customer_options = '';
            while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                $selected_customer = ($customer_row['customer_id'] == $order_row['customer_id']) ? 'selected' : '';
                $customer_options .= "<option value='" . $customer_row['customer_id'] . "' $selected_customer>" . $customer_row['name'] . " " . $customer_row['middle_name'] . " " . $customer_row['lastname'] . "</option>";
            }

            $review_options = '';
            while ($review_row = mysqli_fetch_assoc($review_result)) {
                $selected_review = ($review_row['review_id'] == $order_row['review_id']) ? 'selected' : '';
                $review_options .= "<option value='" . $review_row['review_id'] . "' $selected_review>" . $review_row['review_text'] . "</option>";
            }
			
			$room_options = '';  
            while ($room_row = mysqli_fetch_assoc($room_result)) {
                $selected_room = ($room_row['rooms_id'] == $order_row['rooms_id']) ? 'selected' : '';
                $room_options .= "<option value='" . $room_row['rooms_id'] . "'>" . $room_row['rooms_id'] . "</option>";
            }
            $is_children_checked = ($order_row['is_children'] == 1) ? 'checked' : '';
            $is_pets_checked = ($order_row['is_pets'] == 1) ? 'checked' : '';

            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Order</h1>
                <form action='../../script/edit_orders_script.php' method='POST'>
                    <div class='mb-3'>
                        <label for='customer_id' class='form-label'>Customer:</label>
                        <select class='form-select' name='customer_id' required>
                            $customer_options
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='rooms_id' class='form-label'>Room:</label>
                        <select class='form-select' name='rooms_id' required>
                            $room_options
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='summa' class='form-label'>Summa:</label>
                        <input type='text' class='form-control' name='summa' value='" . $order_row['bill_sum'] . "' required>
                    </div>
                    <div class='mb-3'>
                        <label for='review_id' class='form-label'>Review:</label>
                        <select class='form-select' name='review_id' required>
                            $review_options
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='is_children' class='form-label'>Children:</label>
                        <input type='checkbox' name='is_children' value='1' $is_children_checked>
                    </div>
            
                    <div class='mb-3'>
                        <label for='is_pets' class='form-label'>Pets:</label>
                        <input type='checkbox' name='is_pets' value='1' $is_pets_checked>
                    </div>
            
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Order</button>
                </form>
            </div>";

        } else {
            
            echo "Ошибка при выполнении запроса: " . mysqli_error($conn);
        }
    ?>

<?php endblock() ?>


