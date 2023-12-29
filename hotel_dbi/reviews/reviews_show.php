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
    Hotels Reviews
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

        
        $sql = "SELECT review_id, review_text, rate FROM Reviews";

        
        if (!empty($search)) {
            $sql .= " WHERE 
                role_id LIKE '%$search%' OR 
                role_name LIKE '%$search%' OR 
                employees_salary LIKE '%$search%'";
        }

        $result = $conn->query($sql);
    ?>

<div class="col-md-4" style="width: 0px">
    <div class="card" onclick="location.href='/hotel_dbi/reviews.php';">
        <img src="../../img/back_acc.png" alt="Back Icon">
    </div>
</div>

<h1>Show Reviews</h1>


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
                <th>Reviews_text</th>
                <th>Rate</th>          
            </tr>
        </thead>
        <tbody>
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["review_id"] . "</td>
                            <td>" . $row["review_text"] . "</td>
                            <td>" . $row["rate"] . "</td>
			    <td><a href='./reviews_edit.php?id=" . $row["review_id"] . "'><img src='../../img/pencil.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                            <td><a href='../../script/del_reviews_script.php?id=" . $row["review_id"] . "'><img src='../../img/delete.png' style='width: 40px; border: 0px solid #525a61;'></a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available</td></tr>";
            }

            
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php endblock() ?>