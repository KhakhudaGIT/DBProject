<?php include '../../main_base.php'?>
<style>
.card {
    width: 330px;
    margin: 20px;
    
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
    background-color: transparent;
    border: none;
}
body{
    background: linear-gradient(to bottom right, #98ADDA, #FCD2D3);
    height: 180vh;
}
img {
    border: 2px solid #525a61;
    border-radius: 15px;
    padding: 5px;
}
</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main_pz.css">
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

        
        $search = '';

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        }
		
        
        $sql = "SELECT rooms_id, amount_people, reservation_date, is_reserved,
				(SELECT name FROM Hotels WHERE Rooms.hotel_id = Hotels.hotel_id) AS hotel_name,
                (SELECT name_type FROM Room_types WHERE Rooms.type_id = Room_types.type_id) AS type_name
				FROM Rooms";

        
        if (!empty($search)) {
            $sql .= " WHERE 
                car.car_id LIKE '%$search%' OR 
                car_brand.name_brand LIKE '%$search%' OR 
                car_model.car_model_name LIKE '%$search%' OR 
                car.car_year LIKE '%$search%' OR 
                car.car_vin_code LIKE '%$search%'";
        }

        $result = $conn->query($sql);
    ?>

<div class="col-md-4" style="width: 0px">
    <div class="card" onclick="location.href='/hotel_dbi/rooms.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>

<h1>Show Rooms</h1>


<div class="container mt-3">
    <form action="" method="post">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter search query" value="<?php echo $search; ?>">
        <button type="submit">Search</button>
        <button type="button" onclick="resetFilters()">Reset</button>
    </form>
</div>

<script>
    
    function resetFilters() {
        document.getElementById("search").value = "";
        document.forms[0].submit(); 
    }
</script>

<div class="container mt-5">
    <table class="table" style="margin-top: 50px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount people</th>
                <th>Reservation date</th>
                <th>Is reserved</th>
                <th>Hotel</th>
				<th>Type</th>
                <th style="width: 50px;">Edit</th>
                <th style="width: 50px;">Delete</th>	             
            </tr>
        </thead>
        <tbody>
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["rooms_id"] . "</td>
                            <td>" . $row["amount_people"] . "</td>
                            <td>" . $row["reservation_date"] . "</td>
                            <td>" . $row["is_reserved"] . "</td>
                            <td>" . $row["hotel_name"] . "</td>
							<td>" . $row["type_name"] . "</td>
                            <td><a href='./rooms_edit.php?id=" . $row["rooms_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                            <td><a href='../../script/del_rooms_script.php?id=" . $row["rooms_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available</td></tr>";
            }

            
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php endblock() ?>