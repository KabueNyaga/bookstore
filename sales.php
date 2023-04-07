<?php
    session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location : login.php");
    }

    $user=$_SESSION["username"];

    require_once "config.php";

    $sql="SELECT sales.salesID,sales.Date_of_purchase,sales.Mode_of_payment,inventory.ItemID,inventory.Item_category, inventory.Item_name,sales.Quantity,inventory.Cost,sales.totals  FROM inventory INNER JOIN sales ON sales.itemID=inventory.ItemID ;";
    $result=sqlsrv_query($conn,$sql);
    $rows=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
    $date_conv="";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="inventory.css"/>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        
    </head>
    <body>
        <section class="top-section">
            <img src="bookstore-lg.jpg">
            <p>Logged in as <span class="user-name"><?php echo  $user;?></span></p><br>
            <a class="logout-link" href="logout.php">Logout</a>
        </section>
        <section class="nav-panel">
            <ul class="nav-panel-ul">
                <a href="inventory.php" class="nav-panel-a first "><li class="nav-panel-li">INVENTORY</li></a>
                <a href="suppliers.php" class="nav-panel-a"><li class="nav-panel-li ">SUPPLIER</li></a>
                <a href="sales.php" class="nav-panel-a"><li class="nav-panel-li on-page">SALES</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">ORDERS</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">CLIENT ORDERS</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">DELIVERY</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">SUPPLIER PAYMENT</li></a>
                <a href="entry_forms.php" class="nav-panel-a"><li class="nav-panel-li">ENTRY FORMS</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">REPORTS</li></a>
            </ul>
        </section>
   
            <section class="tables">
                <form class="search-tab" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    <input class="search" type="text" placeholder="search" name="sale_id">
                    <button type="submit" id="search_btn"><ion-icon class="search-button-ion" name="search" ></button>
                </form>
                <table class="search-inv" id="search-inv" >
                    <tr>
                        <th>Sale ID</th>
                        <th>Date Purchased</th>
                        <th>Payment Mode</th>
                        <th>Item ID</th>
                        <th>Category</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Total</th>
                </tr>
                <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST"){

                        //SQL
                        $sql="EXEC select_sale @saleID = ?;";
                        $saleid=trim($_POST["sale_id"]);
                        $param=array($saleid);

                        if($stmt=sqlsrv_prepare($conn,$sql,$param)){
                            if(sqlsrv_execute($stmt)){
                                if(sqlsrv_has_rows($stmt)){
                                    while($rws=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                                        $date_conv=$rws['Date_of_purchase'] -> format('Y-m-d');
                                        echo    
                                        "
                                        <tr>
                                        <td>$rws[salesID]</td>
                                        <td>$date_conv</td>
                                        <td>$rws[Mode_of_payment]</td>
                                        <td>$rws[ItemID]</td>
                                        <td>$rws[Item_category]</td>
                                        <td>$rws[Item_name]</td>
                                        <td>$rws[Quantity]</td>
                                        <td>Ksh $rws[Cost]</td>
                                        <td>Ksh $rws[totals]</td>
                                        </tr>";
                                    } 
                                }else{
                                    die(print_r(sqlsrv_errors()));
                                }
                            }else{
                                die(print_r(sqlsrv_errors()));
                            }
                        }  else{
                            die(print_r(sqlsrv_errors()));
                        }  
                    } 
                    else{
                        
                    While($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                        $date_conv=$row['Date_of_purchase'] -> format('Y-m-d');
                        echo    
                            "
                            <tr>
                            <td>$row[salesID]</td>
                            <td>$date_conv</td>
                            <td>$row[Mode_of_payment]</td>
                            <td>$row[ItemID]</td>
                            <td>$row[Item_category]</td>
                            <td>$row[Item_name]</td>
                            <td>$row[Quantity]</td>
                            <td>Ksh $row[Cost]</td>
                            <td>Ksh $row[totals]</td>
                            </tr>";
                    }    
                    }   
                ?>
                
            </table>
        
                </section>

    </body>    
<html