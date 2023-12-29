<?php include '../../main_base.php'?>
<style>
body{
    background: linear-gradient(to bottom right, #FCF5EC, #459cd6);
    height: 100vh;
}
.mb-3{
    margin-bottom:10px
}
.card {
    width: 330px;
    margin: 20px;
    
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
    background-color: transparent;
    border: none;
}
img {
    border: 2px solid #525a61;
    border-radius: 15px;
    padding: 5px;
}
.container {
        max-width: 3000px;
        margin: 0 auto;
        padding: 250px;
        height: 100vh;
 }

.form-control {
        max-width: 200px;
}

    
h1 {
        white-space: nowrap; 
}

</style>
<?php startblock('link') ?>
    <link rel="stylesheet" href="../../css/style_main.css">
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
    ?>

    <div class="col-md-4" style="width: 0px">
        <div class="card" onclick="location.href='/hotel_dbi/reviews.php';">
            <img src="../../img/back_acc.png" alt="Back Icon">
        </div>
    </div>

    <style>
    .container {
        max-width: 300px; 
        margin: 0 auto; 
        padding: 23px; 
    }

    .form-control {
        max-width: 200px; 
    }
</style>

    
    <div class="container mt-3">
     <h1 class="mt-5" style="text-align: center; margin-top: 100px;">Add new review</h1>
        <form action="../../script/add_reviews_script.php" method="POST" style = "margin-left: 230px;">
            <div class="mb-3">
                <label for="review_text" class="form-label">Review Text:</label>
                <input type="text" class="form-control" name="review_text" id="review_text" required>
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Rate:</label>
                <input type="text" class="form-control" name="rate" id="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Review</button>
        </form>
    </div>

<?php endblock() ?>