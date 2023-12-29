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
<div class="col-md-4" style="width: 0px">
    <div class="card" onclick="location.href='/hotel_dbi/hotels_services.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>
    <h1>Show Hotel services</h1>

    
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
                    <th>Hotel ID</th>
					<th>Service ID</th>
                    <th style="width: 50px;">Edit</th>
                    <th style="width: 50px;">Delete</th>				
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT
							hotels_services_id,
							(SELECT name FROM Hotels WHERE Hotels_services.hotel_id = Hotels.hotel_id) AS hotel_name,
							(SELECT name FROM Services WHERE Hotels_services.service_id = Services.service_id) AS service_name
						FROM 
							Hotels_services";

                
                if(isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql .= " WHERE
                        H.name LIKE '%$search%' OR 
                        S.name LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["hotels_services_id"] . "</td>
                                <td>" . $row["hotel_name"] . "</td>
                                <td>" . $row["service_name"] . "</td>
								<td><a href='./hotels_services_edit.php?id=" . $row["hotels_services_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                                <td><a href='../../script/del_hotels_services_script.php?id=" . $row["hotels_services_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data available</td></tr>";
                }

                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>


<?php endblock() ?>