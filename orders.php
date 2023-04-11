<?php
    session_start();
 
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location : login.php");
    }

    $user=$_SESSION["username"];

    require_once "config.php";

    $sql="select orders.OrderID,orders.Item_ID,inventory.Item_name,orders.Qty_ordered,orders.SupplierID,suppliers.s_name,orders.Date_of_order from orders join inventory on inventory.ItemID=orders.Item_ID join suppliers on suppliers.supplierID=orders.SupplierID;";
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
                <a href="sales.php" class="nav-panel-a"><li class="nav-panel-li ">SALES</li></a>
                <a href="orders.php" class="nav-panel-a"><li class="nav-panel-li on-page">ORDERS</li></a>
                <a href="client_orders.php" class="nav-panel-a"><li class="nav-panel-li">CLIENT ORDERS</li></a>
                <a href="deliveries.php" class="nav-panel-a"><li class="nav-panel-li">DELIVERY</li></a>
                <a href="supplier_pay.php" class="nav-panel-a"><li class="nav-panel-li">SUPPLIER PAYMENT</li></a>
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
                        <th>Order ID</th>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Quanity</th>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Date Ordered</th>
                </tr>
                <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST"){

                        //SQL
                        $sql="EXEC select_ord @orderID = ?;";
                        $saleid=trim($_POST["sale_id"]);
                        $param=array($saleid);

                        if($stmt=sqlsrv_prepare($conn,$sql,$param)){
                            if(sqlsrv_execute($stmt)){
                                if(sqlsrv_has_rows($stmt)){
                                    while($rws=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
                                        $date_conv=$rws['Date_of_order'] -> format('Y-m-d');
                                        echo    
                                        "
                                        <tr>
                                        <td>$rws[OrderID]</td>
                                        <td>$rws[Item_ID]</td>
                                        <td>$rws[Item_name]</td>
                                        <td>$rws[Qty_ordered]</td>
                                        <td>$rws[SupplierID]</td>
                                        <td>$rws[s_name]</td>
                                        <td>$date_conv</td>            
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
                        $date_conv=$row['Date_of_order'] -> format('Y-m-d');
                        echo    
                            "
                            <tr>
                            <td>$row[OrderID]</td>
                            <td>$row[Item_ID]</td>
                            <td>$row[Item_name]</td>
                            <td>$row[Qty_ordered]</td>
                            <td>$row[SupplierID]</td>
                            <td>$row[s_name]</td>
                            <td>$date_conv</td>
                            </tr>";
                    }    
                    }   
                ?>
                
            </table>
        
                </section>

    </body>    
<html