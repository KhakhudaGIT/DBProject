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
    AvtoStore Customer
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
        <div class="card" onclick="location.href='/hotel_dbi/customers.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <?php
        if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    
        
        $sql = "SELECT * FROM Customers WHERE customer_id = $id";
        $result = mysqli_query($conn, $sql);
    
        
        if ($result) {
            
            $row = mysqli_fetch_assoc($result);
    
            
            $name = isset($row['name']) ? $row['name'] : '';
            $number = isset($row['number']) ? $row['number'] : '';
            $email = isset($row['email']) ? $row['email'] : '';
            $birthday = isset($row['birthday']) ? $row['birthday'] : '';
            $middle_name = isset($row['middle_name']) ? $row['middle_name'] : '';
            $lastname = isset($row['lastname']) ? $row['lastname'] : '';

            
            echo "<div class='container mt-3'>
                <h1 class='mt-5' style='text-align: center; margin-top: 100px;'>Edit Customers</h1>
                <form action='../../script/edit_customer_script.php' method='POST'>
                <div class='mb-3'>
                <label for='name' class='form-label'>Name:</label>
                <input type='text' class='form-control' value='$name' name='name' id='name' required>
            </div>
            <div class='mb-3'>
                <label for='number' class='form-label'>Number:</label>
                <input type='text' class='form-control' value='$number' name='number' id='number'>
            </div>
            <div class='mb-3'>
                <label for='email' class='form-label'>Email:</label>
                <input type='email' class='form-control' value= '$email' name='email' id='email' required>
            </div>
            <div class='mb-3'>
                <label for='birthday' class='form-label'>Birthday:</label>
                <input type='date' class='form-control' value ='$birthday' name='birthday' id='birthday' required>
            </div>
            <div class='mb-3'>
                <label for='middle_name' class='form-label'>Middle name:</label>
                <input type='text' class='form-control' value = '$middle_name'  name='middle_name' id='middle_name'>
            </div>
            <div class='mb-3'>
                <label for='lastname' class='form-label'>Last name:</label>
                <input type='text' class='form-control' value='$lastname' name='lastname' id='lastname'>
            </div>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' class='btn btn-primary'>Update Customers</button>
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


