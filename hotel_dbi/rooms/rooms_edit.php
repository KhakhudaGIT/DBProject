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

    <?php
        if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    
        
        $sql = "SELECT * FROM Rooms WHERE rooms_id = $id";
        $result = mysqli_query($conn, $sql);
    
        
        if ($result) {
            
            $room_row = mysqli_fetch_assoc($result);


            
            $amount_people = isset($room_row['amount_people']) ? $room_row['amount_people'] : '';
            $reservation_date = isset($room_row['reservation_date']) ? $room_row['reservation_date'] : '';
            $is_reserved = isset($room_row['is_reserved']) ? $room_row['is_reserved'] : '';
			
			$is_reserved = ($room_row['is_reserved'] == 1) ? 'checked' : '';
			
			
            
            echo "<div class='container mt-3'>
                    <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Room</h1>
                    <form action='../../script/edit_rooms_script.php' method='POST'>
                        <div class='mb-3'>
							<label for='amount_people' class='form-label'>Amount people:</label>
							<input type='text' class='form-control' name='amount_people' id='amount_people' value='$amount_people' required>
						</div>
						<div class='mb-3'>
							<label for='reservation_date' class='form-label'>Reservatio DATE:</label>
							<input type='date' class='form-control' name='reservation_date' id='reservation_date' value='$reservation_date' required>
						</div>
						<div class='mb-3'>
							<label for='is_reserved' class='form-label'>Reserved:</label>
							<input type='checkbox' name='is_reserved' value='1' $is_reserved>
						</div>
						<div class='mb-3'>
                            <label for='hotel_id' class='form-label'>Hotel:</label>
                            <select class='form-select' name='hotel_id' id='hotel_id' required>";
    
            
            $hotel_query = "SELECT DISTINCT Rooms.hotel_id, Hotels.name AS hotel_name
							FROM Rooms
							JOIN Hotels ON Rooms.hotel_id = Hotels.hotel_id;
							";
			$hotel_result = mysqli_query($conn, $hotel_query);
    
            
            while ($hotel_row = mysqli_fetch_assoc($hotel_result)) {
				$selected = ($hotel_row['hotel_id'] == $room_row['hotel_id']) ? 'selected' : '';
				echo "<option value='" . $hotel_row['hotel_id'] . "' $selected>" . $hotel_row['hotel_name'] . "</option>";
			}
			
			
			
			
			
            
            echo "</select>
                    </div>
					<div class='mb-3'>
						<label for='type_id' class='form-label'>Room Type:</label>
						<select class='form-select' name='type_id' id='type_id' required>";
						
			$type_query = "SELECT type_id, (SELECT name_type FROM Room_types WHERE Rooms.type_id = Room_types.type_id) AS name_type
                FROM Rooms;";
			$type_result = mysqli_query($conn, $type_query);

			while ($type_row = mysqli_fetch_assoc($type_result)) {
				$selected_type = ($type_row['type_id'] == $room_row['type_id']) ? 'selected' : '';
				echo "<option value='" . $type_row['type_id'] . "' $selected_type>" . $type_row['name_type'] . "</option>";
			}

			echo "</select>
				</div>
                    <input type='hidden' name='id' value='$id'>
        
                    <button type='submit' class='btn btn-primary'>Update Room</button>
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


