<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="land_page.css"/>
    </head>
    <body>
        <section class="top-section">
            <img src="bookstore-lg.jpg">
            <p>Logged in as <span class="user-name">username</span></p><br>
            <a class="logout-link" href="logout.php">Logout</a>
        </section>
        <section class="nav-sec">
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
            <div class="nav-buttons"></div>
        </section>
    </body>
</html>