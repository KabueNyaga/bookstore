<?php
    $db_server="UNKNOWN";
    $db_name="bookstore";
    $db_user="";
    $db_pass="";

    $connection_info=array(
        "Database" => $db_name,
        "Uid" => $db_user,
        "PWD" => $db_pass
    );
    $conn=sqlsrv_connect($db_server,$connection_info);
?>