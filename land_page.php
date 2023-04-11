<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;   
}
$user=$_SESSION["username"];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="land_page.css"/>
        <script type="text/javascript"  src="bookstore.js"></script>
    </head>
    <body>
        <section class="top-section">
            <img src="bookstore-lg.jpg">
            <p>Logged in as <span class="user-name"><?php echo  $user;?></span></p><br>
            <a class="logout-link" href="logout.php">Logout</a>
        </section>
        <section class="nav-sec">
            <h2 class="dash">Dashboard</h2>
            <div class="nav-button-container">
            <div class="nav-buttons" id="nav-button1" >
                <p class="button-desc d1">INVENTORY</p>
            </div>
            <div class="nav-buttons" id="nav-button2" >
            <p class="button-desc d2">SUPPLIERS</p>
            </div>
            <div class="nav-buttons" id="nav-button3" >
                <p class="button-desc d3">SALES</p>
            </div>
            <div class="nav-buttons" id="nav-button4" >
            <p class="button-desc d4">ORDERS</p>
            </div>
            <div class="nav-buttons" id="nav-button5" >
            <p class="button-desc d5">CLIENT ORDERS</p>
            </div>
            <div class="nav-buttons" id="nav-button6">
            <p class="button-desc d6">DELIVERIES</p>
            </div>
            <div class="nav-buttons" id="nav-button7" >
            <p class="button-desc d7">SUPPLIER PAYMENT</p>
            </div>
            <div class="nav-buttons" id="nav-button8">
            <p class="button-desc d8">ENTRY FORMS</p>
            </div>
            <div class="nav-buttons" id="nav-button9" >
                <p class="button-desc d9">REPORTS</p>
            </div>
            </div>  
        </section>
    </body>
</html>