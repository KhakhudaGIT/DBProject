<?php include '../../main_base.php'?>
<style>
    body {
        justify-content: left;
    }

    .mb-3 {
        margin-bottom: 10px;
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
       
        height: auto;
        border: 2px solid #525a61;
        border-radius: 15px;
        padding: 5px;
    }

    .container {
        max-width: 3000px;
        margin: 0 auto;
        padding: 250px;
		height:100vh
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
    Hotels Rooms
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
        <div class="card" onclick="location.href='/hotel_dbi/rooms.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>



    
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new Room</h1>
        <form action="../../script/add_rooms_script.php" method="POST" style = "margin-left: 230px;">
            
            <div class="mb-3">
                <label for="amount_people" class="form-label">Amount people:</label>
                <input type="text" class="form-control" name="amount_people" id="amount_people" required>
            </div>
            <div class="mb-3">
                <label for="reservation_date" class="form-label">Reservation date:</label>
                <input type="date" class="form-control" name="reservation_date" id="reservation_date" required>
            </div>
			<div class="mb-3">
                <div class="form-group">
                    <label for="is_reserved">Is reserved:</label>
				    <select class="form-control" id="is_reserved" name="is_reserved">
					    <option value = 1>Reserved</option>
						<option value = 0>Not reserved</option>
				  </select>
				</div>
            </div>

            <div class="mb-3">
                <label for="hotel_id" class="form-label">Hotel Name:</label>
                <select class="form-select" name="hotel_id" id="hotel_id" required>
                    <?php
                        
                        $hotel_query = "SELECT DISTINCT hotel_id,
                        (SELECT name FROM Hotels WHERE Rooms.hotel_id = Hotels.hotel_id) AS hotel_name FROM Rooms";
                        $hotel_result = mysqli_query($conn, $hotel_query);
                    
                        
                        if ($hotel_result) {
                            
                            while ($hotel_row = mysqli_fetch_assoc($hotel_result)) {
                                echo "<option value='" . $hotel_row['hotel_id'] . "'>" . $hotel_row['hotel_name'] . 
                                "</option>";
                            }
                            
                            mysqli_free_result($hotel_result);
                        } else {
                            
                            echo "Помилка запиту: " . mysqli_error($conn);
                        }
                    ?>
                </select>
            </div>
			
			<div class="mb-3">
                <label for="type_id" class="form-label">Type Name:</label>
                <select class="form-select" name="type_id" id="type_id" required>
                    <?php
                        
                        $type_query = "SELECT DISTINCT type_id,
                        (SELECT name_type FROM Room_types WHERE Rooms.type_id = Room_types.type_id) AS type_name FROM Rooms";
                        $type_result = mysqli_query($conn, $type_query);
                    
                        
                        if ($type_result) {
                            
                            while ($type_row = mysqli_fetch_assoc($type_result)) {
                                echo "<option value='" . $type_row['type_id'] . "'>" . $type_row['type_name'] . 
                                "</option>";
                            }
                            
                            mysqli_free_result($type_result);
                        } else {
                            
                            echo "Помилка запиту: " . mysqli_error($conn);
                        }
                    ?>
                </select>
            </div>
			
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
    </div>

<?php endblock() ?>