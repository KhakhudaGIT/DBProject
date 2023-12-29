<?php include 'main_base.php'?>

<?php startblock('link') ?>
    <link rel="stylesheet" href="css/style_main_pz.css">
<?php endblock() ?>


<?php startblock('titlePage') ?>
    Hotel Info
<?php endblock() ?>

<?php startblock('bodyPageMain') ?>
    <?php 
		require_once 'script/connect.php';
		if (!isset($_SESSION['email'])) {
        	header('Location: auth_page.php');
        	exit();
    	}

	?>
	
	<h1>Hotels complex</h1>
    <style>
    
    body {
        background: linear-gradient(to bottom, #A9F1DF, #FFBBBB);
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

    .button-container {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }
</style>

<div class="card-container">
   
	
	<div class="card" onclick="location.href='hotel_dbi/hotels.php';">
        <img src="img/hotel.png" alt="Hotels Icon">
        <h3>Hotels</h3>
    </div>

    <div class="card" onclick="location.href='hotel_dbi/rooms.php';">
        <img src="img/room.png" alt="Car Icon">
        <h3>Rooms</h3>
    </div>

    <div class="card" onclick="location.href='hotel_dbi/reviews.php';">
        <img src="img/review.png" alt="Reviews Icon">
        <h3>Reviews</h3>
    </div>

    <div class="card" onclick="location.href='hotel_dbi/services.php';">
        <img src="img/service.png" alt="Services Icon">
        <h3>Services</h3>
    </div>    

    <div class="card" onclick="location.href='hotel_dbi/customers.php';">
        <img src="img/customers.png" alt="Customers Icon">
        <h3>Customers</h3>
    </div>
	
	 <div class="card" onclick="location.href='hotel_dbi/orders.php';">
        <img src="img/orders.png" alt="Bill Icon">
        <h3>Orders</h3>
    </div>

    <div class="card" onclick="location.href='hotel_dbi/additional_services.php';">
        <img src="img/additional.png" alt="User Icon">
        <h3>Additional services</h3>
    </div>
	
	<div class="card" onclick="location.href='hotel_dbi/orders_services.php';">
        <img src="img/orders_servise.png" alt="User Icon">
        <h3>Orders services</h3>
    </div>
	
	<div class="card" onclick="location.href='hotel_dbi/hotels_services.php';">
        <img src="img/hotels_servise.png" alt="User Icon">
        <h3>Hotels services</h3>
    </div>
	
	<div class="card" onclick="location.href='account.php';">
        <img src="img/account.png" alt="Back Icon">
        <h3>Account</h3>
    </div>
</div>

<div class="button-container">
    <h2 style="text-align: center; margin-bottom: 20px; font-size: 18px;">Follow us on social media</h2>
    <a href="https:
        <img src="img/instagram1.png" alt="Instagram Icon"> 
    </a>
</div>

<iframe src="https:


<?php endblock() ?>