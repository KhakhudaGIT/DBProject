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
    Orders
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
    <h1>Show Orders</h1>

    
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
                    <th>Customer Name</th>
					<th>Lastname</th>
                    <th>Room ID</th>
                    <th>Bill Sum</th>
                    <th>Review</th>
                    <th>Children</th>
                    <th>Pets</th>   
                    <th style="width: 50px;">Edit</th>
                    <th style="width: 50px;">Delete</th>				
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT
							order_id, rooms_id, bill_sum, is_children, is_pets,
							(SELECT name FROM Customers WHERE Orders.customer_id = Customers.customer_id) AS customer_name,
							(SELECT lastname FROM Customers WHERE Orders.customer_id = Customers.customer_id) AS lastname,
							(SELECT review_text FROM Reviews WHERE Orders.review_id = Reviews.review_id) AS review_text
						FROM 
							Orders";

                
                if(isset($_POST['search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql .= " WHERE 
                        O.order_id LIKE '%$search%' OR  
                        C.customer_name LIKE '%$search%' OR 
                        C.lastname LIKE '%$search%' OR 
                        R.rooms_id LIKE '%$search%' OR
                        O.bill_sum LIKE '%$search%' OR 
                        O.is_children LIKE '%$search%' OR
						O.is_pets LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["order_id"] . "</td>
                                <td>" . $row["customer_name"] . "</td>
                                <td>" . $row["lastname"] . "</td>
                                <td>" . $row["rooms_id"] . "</td>
                                <td>" . $row["bill_sum"] . "</td>
                                <td>" . $row["review_text"] . "</td>
                                <td>" . $row["is_children"] . "</td>
								<td>" . $row["is_pets"] . "</td>
								<td><a href='./order_edit.php?id=" . $row["order_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                                <td><a href='../../script/del_orders_script.php?id=" . $row["order_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
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