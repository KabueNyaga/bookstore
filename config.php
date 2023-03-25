<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME','book_admin');
    define('DB_PASSWORD','egg');
    define('DB_NAME','bookstore');

    $link=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

    if($link==false){
        die("CONNECTION ERROR");
    }
?>