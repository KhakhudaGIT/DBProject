<?php include '../main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="../css/style_main_pz.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    Hotels Additional_services
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>
<h1>Additional services</h1>

<style>

    body {
        background: linear-gradient(to bottom, #F7CDE1, #97F7F5);
        height: 1200px;  
    }
    .card {

        transition: transform 0.3s ease-in-out;
        background-color: rgba(255, 255, 255, 0.5); 
        border-radius: 10px; 
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    
    .card:hover h3 {
        color: #459cd6;
    }

    .btn.btn-primary {
        background-color: transparent;
        border-color: transparent;
        color: #000;
        text-align: center;
        padding-left: 10px;
    }
    .btn.btn-primary:hover {
        background-color: transparent;
        border-color: transparent;
        color: #87CEFA;
    }
    h1 {
        margin-bottom: 50px;
    }
</style>
<div class="container mt-5" style="margin-top: 50px;">
    <div class="row justify-content-center text-center">
        <div class="col-md-4">
            <div class="card" onclick="location.href='./additional_services/additional_services_show.php';">
                <a href="./additional_services/additional_services_show.php" class="btn btn-primary btn-block">
                    <img src="../img/show.png" alt="Show Icon">
                    <h3>Show Information</h3>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" onclick="location.href='./additional_services/additional_services_add.php';">
                <a href="./additional_services/additional_services_add.php" class="btn btn-primary btn-block">
                    <img src="../img/add1.png" alt="Add Icon">
                    <h3>Add Information</h3>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" onclick="location.href='../main_page.php';">
                <a href="../main_page.php" class="btn btn-primary btn-block">
                    <img src="../img/back_acc.png" alt="Back Icon">
                    <h3>Hotels complex</h3>
                </a>
            </div>
        </div>
    </div>
</div>

<?php endblock() ?>
