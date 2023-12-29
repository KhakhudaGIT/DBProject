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
    height: 100vh;
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

    <h1>Show Hotels</h1>
	
	
	

    
    <div class="container mt-3">
	
        <form action="" method="post">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" placeholder="Enter search query">
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
                    <th>Name</th>
                    <th>Locality</th>
                    <th>Adress</th>
					<th>Capacity</th>
					<th>Rank</th>
                    <th style="width: 50px;">Edit</th>
                    <th style="width: 50px;">Delete</th>	            
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT * FROM Hotels";

                
                if(isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql .= " WHERE 
                               hotel_id LIKE '%$search%' OR 
                               name LIKE '%$search%' OR 
                               locality LIKE '%$search%' OR 
                               adress LIKE '%$search%' OR
							   capacity LIKE '%$search%' OR
							   rang LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["hotel_id"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["locality"] . "</td>
                                <td>" . $row["adress"] . "</td>
								<td>" . $row["capacity"] . "</td>
								<td>" . $row["rang"] . "</td>
                                <td><a href='./hotels_edit.php?id=" . $row["hotel_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                                <td><a href='../../script/del_hotels_script.php?id=" . $row["hotel_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }

                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
	

<?php endblock() ?>