<?php 
     session_start();
    
     if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
         header("location : login.php");
     }

     require_once "config.php";
     $user=$_SESSION["username"];

     $itemid=$itemcategory=$itemname=$itemquantity=$itemcost=$itemsupplier="";
     $supplierid=$suppliername=$suppliertel=$supplieraddr="";
     $saleid=$dateofpurchase=$modeofpayment=$quantity=$itmid=$itmnm="";
     $orderid=$orderitm=$qty=$sup="";
     $cloid=$clientid=$clientname=$clientemail="";

     $err=$err2=$err3=$err4=$err5=$err6=$err7="";
     $serr=$serr2=$serr3=$serr4=$serr5="";
     $sserr=$sserr2=$sserr3=$sserr4=$sserr5="";
     $ssserr=$ssserr2=$ssserr3=$ssserr4=$ssserr5="";
     $sssserr=$sssserr2=$sssserr3=$sssserr4=$sssserr5=$sssserr6=$sssserr7=$sssserr8=$sssserr9=$sssserr10="";

     $er=$er2=$er3=$er4=$er5="";
     $dt=date('Y/m/d');

     if( !empty($_POST["inv-submit"]) and $_SERVER["REQUEST_METHOD"]=="POST"){


        //SQL  
        $sql="SELECT Item_name FROM inventory WHERE ItemID = ? ";
        $itemid=trim($_POST["item_id"]);
        $param=array($itemid);
        if($stmt=sqlsrv_prepare($conn,$sql,$param)){
            if(sqlsrv_execute($stmt)){
                if(sqlsrv_has_rows($stmt)){
                    $err="Item already exists!";
                }elseif(empty(trim($_POST["item_id"]))){
                    $err2="Item id cannot be empty!";
                }elseif(empty(trim($_POST["item_category"]))){
                    $err3="Item category cannot be empty!";
                }elseif(empty(trim($_POST["item_name"]))){
                    $err4="Item name cannot be empty!";
                }elseif(empty(trim($_POST["item_quantity"]))){
                    $err5="Item quantity cannot be empty!";
                }elseif(empty(trim($_POST["item_cost"]))){
                    $err6="Item cost cannot be empty!";
                }elseif(empty(trim($_POST["item_supplier"]))){
                    $err7="Item supplier cannot be empty!";
                }
               
                else
                {
                    $itemid=trim($_POST["item_id"]);
                    $itemcategory=trim($_POST["item_category"]);
                    $itemname=trim($_POST["item_name"]);
                    $itemquantity=trim($_POST["item_quantity"]);
                    $itemcost=trim($_POST["item_cost"]);
                    $itemsupplier=trim($_POST["item_supplier"]);

                    $sql2="INSERT INTO inventory (ItemID,Item_category,Item_name,Quantity,Cost,supplierID) VALUES (?,?,?,?,?,?)";
                    $param=array($itemid,$itemcategory,$itemname,$itemquantity,$itemcost,$itemsupplier);
                    if($stmt=sqlsrv_prepare($conn,$sql2,$param)){
                        if(sqlsrv_execute($stmt)){
                            $status_insert=1;
                    }else{
                    die(print_r(sqlsrv_errors()));
                    }   
                    }
                }
                if($err){
                    $er="Error in submiting. Click form to see error.";
                }
            }
            else{
                die(print_r(sqlsrv_errors()));
            }
        }else{
            die(print_r(sqlsrv_errors()));
        }

        //SQL
       
      
     }

    if( !empty($_POST["sup-submit"]) and $_SERVER["REQUEST_METHOD"]=="POST"){
    
        //SQL  
        $sql="SELECT supplierID FROM suppliers WHERE supplierID = ? ";
        $supplierid=trim($_POST["supplier_id"]);
        $param=array($supplierid);
        if($stmt=sqlsrv_prepare($conn,$sql,$param)){
            if(sqlsrv_execute($stmt)){
                if(sqlsrv_has_rows($stmt)){
                    $serr="Item already exists";
                }
                if(empty(trim($_POST["supplier_id"]))){
                    $serr2="Item id cannot be empty!";
                }
                if(empty(trim($_POST["supplier_name"]))){
                    $serr3="Item category cannot be empty!";
                }
                if(empty(trim($_POST["tel_no"]))){
                    $serr4="Item name cannot be empty!";
                }
                if(empty(trim($_POST["address"]))){
                    $serr5="Item quantity cannot be empty!";
                }
               
                if(empty($serr&&$serr2&&$serr3&&$serr4&&$serr5))
                {
                    $supplierid=trim($_POST["supplier_id"]);
                    $suppliername=trim($_POST["supplier_name"]);
                    $suppliertel=trim($_POST["tel_no"]);
                    $supplieraddr=trim($_POST["address"]);
                    
                    //SQL
                    $sql22="INSERT INTO suppliers (supplierID,s_name,Tel_no,s_address) VALUES (?,?,?,?)";
                    $param2=array($supplierid,$suppliername,$suppliertel,$supplieraddr);
                    if($stmt=sqlsrv_prepare($conn,$sql22,$param2)){
                        if(sqlsrv_execute($stmt)){
                            $status_insert=1;
                        }
                  
                }
                if($serr || $serr2 || $serr3 || $serr4 || $serr5){
                    $er2="Error in submiting. Click form to see error.";
                }
            }
        } 
    }
}


if( !empty($_POST["sale-submit"]) and $_SERVER["REQUEST_METHOD"]=="POST"){
    
    //SQL  
    $sql="SELECT salesID FROM sales WHERE salesID = ? ";
    $supplierid=trim($_POST["sale_id"]);
    $param=array($supplierid);
    if($stmt=sqlsrv_prepare($conn,$sql,$param)){
        if(sqlsrv_execute($stmt)){
            if(sqlsrv_has_rows($stmt)){
                $sserr="Item already exists";
            }
            /*if(empty(trim($_POST["date_of_purchase"]))){
                $sserr2="Item id cannot be empty!";
            }*/
            if(empty(trim($_POST["mode_of_payment"]))){
                $sserr3="Item category cannot be empty!";
            }
            if(empty(trim($_POST["quantity"]))){
                $sserr4="Item name cannot be empty!";
            }
            if(empty(trim($_POST["item_name"]))){
                $sserr5="Item quantity cannot be empty!";
            }
           
            if(empty($sserr&&$sserr2&&$sserr3&&$sserr4&&$sserr5))
            {
                $saleid=trim($_POST["sale_id"]);
                $dateofpurchase=trim($_POST["date_of_purchase"]);
                $modeofpayment=trim($_POST["mode_of_payment"]);
                $quantity=trim($_POST["quantity"]);
                $itmnm=trim($_POST["item_name"]);
            
                //SQL 
                $sq="SELECT ItemID FROM inventory  WHERE Item_name= ? ";
                $par=array($itmnm);
                $st=sqlsrv_prepare($conn,$sq,$par);
                if(sqlsrv_execute($st)){
                    while($rw=sqlsrv_fetch_array($st,SQLSRV_FETCH_ASSOC)){
                        $itmid=$rw['ItemID'];
                    }
                    
                }
                else{
                    die(print_r(sqlsrv_errors()));
                }
                
                //SQL
                $sql22="INSERT INTO sales (salesID,/*Date_of_purchase,*/Mode_of_payment,quantity,ItemID) VALUES (?,'$dt',?,?,?)";
                $param2=array($saleid,/*$modeofpayment,*/$quantity,$itmid);
                if($stmt=sqlsrv_prepare($conn,$sql22,$param2)){
                    if(sqlsrv_execute($stmt)){
                        $status_insert=1;
                    }
   
            }
            if($sserr || $sserr2 || $sserr3 || $sserr4 || $sserr5){
                $er3="Error in submiting. Click form to see error.";
            }
        }
    } 
}
}


if( !empty($_POST["ord-submit"]) and $_SERVER["REQUEST_METHOD"]=="POST"){
    
    //SQL  
    $sql="SELECT OrderID FROM orders WHERE OrderID = ? ";
    $orderid=trim($_POST["order_id"]);
    $param=array($orderid);
    if($stmt=sqlsrv_prepare($conn,$sql,$param)){
        if(sqlsrv_execute($stmt)){
            if(sqlsrv_has_rows($stmt)){
                $ssserr="Item already exists";
            }
            if(empty(trim($_POST["order_id"]))){
                $sserr2="Order id cannot be empty!";
            }
            if(empty(trim($_POST["item_name"]))){
                $ssserr3="Item cannot be empty";
            }
            if(empty(trim($_POST["quantity"]))){
                $ssserr4="Quantity cannot be empty!";
            }
            if(empty(trim($_POST["supplier_name"]))){
                $ssserr5="Supplier cannot be empty!";
            }
            /*if(empty(trim($_POST["o_date"]))){
                $ssserr6="Item quantity cannot be empty!";
            }*/
           
            if(empty($ssserr&&$ssserr2&&$ssserr3&&$ssserr4&&$ssserr5))
            {
                $orderid=trim($_POST["order_id"]);
                $orderitm=trim($_POST["item_name"]);
                //$modeofpayment=trim($_POST["mode_of_payment"]);
                $qty=trim($_POST["quantity"]);
                $sup=trim($_POST["supplier_name"]);
            
                //SQL 
                $sq="SELECT ItemID FROM inventory  WHERE Item_name= ? ";
                $par=array($orderitm);
                $st=sqlsrv_prepare($conn,$sq,$par);
                if(sqlsrv_execute($st)){
                    while($rw=sqlsrv_fetch_array($st,SQLSRV_FETCH_ASSOC)){
                        $itmid=$rw['ItemID'];
                    }
                    
                }
                else{
                    die(print_r(sqlsrv_errors()));
                }
                $sq2="SELECT SupplierID FROM suppliers  WHERE s_name= ? ";
                $par1=array($sup);
                $st=sqlsrv_prepare($conn,$sq2,$par1);
                if(sqlsrv_execute($st)){
                    while($rw1=sqlsrv_fetch_array($st,SQLSRV_FETCH_ASSOC)){
                        $itmid1=$rw1['SupplierID'];
                    }
                    
                }
                else{
                    die(print_r(sqlsrv_errors()));
                }
                
                //SQL
                $sql22="INSERT INTO orders (OrderID,Item_ID,Qty_ordered,SupplierID,Date_of_order) VALUES (?,?,?,?,'$dt')";
                $param2=array($orderid,$itmid,$qty,$itmid1);
                if($stmt=sqlsrv_prepare($conn,$sql22,$param2)){
                    if(sqlsrv_execute($stmt)){
                        $status_insert=1;
                    }
   
            }
            if($ssserr || $ssserr2 || $ssserr3 || $ssserr4 || $ssserr5){
                $er4="Error in submiting. Click form to see error.";
            }
        }
    } 
}
}

if( !empty($_POST["clo-submit"]) and $_SERVER["REQUEST_METHOD"]=="POST"){
    
    //SQL  
    $sql="SELECT client_orderID FROM client_orders WHERE client_orderID = ? ";
    $cloid=trim($_POST["clo_id"]);
    $param=array($cloid);
    if($stmt=sqlsrv_prepare($conn,$sql,$param)){
        if(sqlsrv_execute($stmt)){
            if(sqlsrv_has_rows($stmt)){
                $sssserr="Item already exists";
            }
            if(empty(trim($_POST["clo_id"]))){
                $sssserr2="Client order id cannot be empty!";
            }
            if(empty(trim($_POST["client_id"]))){
                $sssserr3="Client id cannot be empty";
            }
            if(empty(trim($_POST["client_name"]))){
                $sssserr4="Name cannot be empty!";
            }
            if(empty(trim($_POST["client_email"]))){
                $sssserr5="Supplier cannot be empty!";
            }

            //SQL  
            $sql2="SELECT OrderID FROM orders WHERE OrderID = ? ";
            $orderid=trim($_POST["order_id"]);
            $param2=array($orderid);
            if($stmt2=sqlsrv_prepare($conn,$sql2,$param2)){
                if(sqlsrv_execute($stmt2)){
                    if(sqlsrv_has_rows($stmt2)){
                        $sssserr6="Order already exist";
                    }
                    if(empty(trim($_POST["order_id"]))){
                        $sssserr7="Order id cannot be empty!";
                    }
                    if(empty(trim($_POST["item_name"]))){
                        $sssserr8="Item cannot be empty";
                    }
                    if(empty(trim($_POST["quantity"]))){
                        $sssserr9="Quantity cannot be empty!";
                    }
                    if(empty(trim($_POST["supplier_name"]))){
                        $sssserr10="Supplier cannot be empty!";
                    }
                }
            }
            if(empty($sssserr&&$sssserr2&&$sssserr3&&$sssserr4&&$sssserr5&&$sssserr6&&$sssserr7&&$sssserr8&&$sssserr9&&$sssserr10))
            {   $cloid=trim($_POST["clo_id"]);
                $clientid=trim($_POST["client_id"]);
                $clientname=trim($_POST["client_name"]);
                $clientemail=trim($_POST["client_email"]);
                $orderid=trim($_POST["order_id"]);
                $orderitm=trim($_POST["item_name"]);
                //$modeofpayment=trim($_POST["mode_of_payment"]);
                $qty=trim($_POST["quantity"]);
                $sup=trim($_POST["supplier_name"]);
            
                //SQL 
                $sq="SELECT ItemID FROM inventory  WHERE Item_name= ? ";
                $par=array($orderitm);
                $st=sqlsrv_prepare($conn,$sq,$par);
                if(sqlsrv_execute($st)){
                    while($rw=sqlsrv_fetch_array($st,SQLSRV_FETCH_ASSOC)){
                        $itmid=$rw['ItemID'];
                    }
                    
                }
                else{
                    die(print_r(sqlsrv_errors()));
                }
                $sq2="SELECT SupplierID FROM suppliers  WHERE s_name= ? ";
                $par1=array($sup);
                $st=sqlsrv_prepare($conn,$sq2,$par1);
                if(sqlsrv_execute($st)){
                    while($rw1=sqlsrv_fetch_array($st,SQLSRV_FETCH_ASSOC)){
                        $itmid1=$rw1['SupplierID'];
                    }
                    
                }
                else{
                    die(print_r(sqlsrv_errors()));
                }
                
               

                //SQL
                $sql221="INSERT INTO Client_orders (client_orderID,client_ID,client_name,client_email,OrderID) VALUES (?,?,?,?,?)";
                $param21=array($cloid,$clientid,$clientname,$clientemail,$orderid);
                if($stmt2=sqlsrv_prepare($conn,$sql221,$param21)){
                    if(sqlsrv_execute($stmt2)){
                        $status_insert=1;
                        //SQL
                        $sql22="INSERT INTO orders (OrderID,Item_ID,Qty_ordered,SupplierID,Date_of_order) VALUES (?,?,?,?,'$dt')";
                        $param2=array($orderid,$itmid,$qty,$itmid1);
                        if($stmt=sqlsrv_prepare($conn,$sql22,$param2)){
                        if(sqlsrv_execute($stmt)){
                            $status_insert=1;
                        }
                    }
   
                }

                 
            if($sssserr||$sssserr2||$sssserr3||$sssserr4||$sssserr5||$sssserr6||$sssserr7||$sssserr8||$sssserr9||$sssserr10){
                $er5="Error in submiting. Click form to see error.";
            }

        }
    } 
}
}
}
        
    
    
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="entry_forms.css"/>
        <script type="text/javascript"  src="bookstore.js"></script>
    
</script>
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
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">SUPPLIER</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">SALED</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">ORDERS</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">CLIENT ORDERS</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">DELIVERY</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">SUPPLIER PAYMENT</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li on-page">ENTRY FORMS</li></a>
                <a href="#" class="nav-panel-a"><li class="nav-panel-li">REPORTS</li></a>
            </ul>
    </body>
    <section class="nav-sec">   
            <div class="nav-button-container">
            <div class="nav-buttons" id="nav-button1-1"  >
                <p class="button-desc">INVENTORY FORM</p>
                <span class="error_msgf"><?php echo $er;?></span>
            </div>
            

            <div class="nav-buttons" id="nav-button2-2" >
                <p class="button-desc">SUPPLIERS FORM</p>
                <span class="error_msgf"><?php echo $er2;?></span>
            </div>

            <div class="nav-buttons" id="nav-button3-3" >
                <p class="button-desc">SALES FORM</p>
                <span class="error_msgf"><?php echo $er3;?></span>
            </div>
           
            <div class="nav-buttons" id="nav-button4-4" >
                <p class="button-desc">ORDERS FORM</p>
                <span class="error_msgf"><?php echo $er4;?></span>
            </div>
            
            <div class="nav-buttons" id="nav-button5-5" >
                <p class="button-desc">CLIENT ORDERS FORM</p>
                <span class="error_msgf"><?php echo $er5;?></span>
            </div>
            
            </div>  
        </section>
        <section class="inv-form">
            <h2>INVENTORY FORM</h2>
            <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="inv-f" >
                <label class="l-1" for="item_id">Item ID
                    <input type="text" placeholder="id(j,m,b,sp,a,s)" class="item" name="item_id" id="item_id" required><br>
                    <span class="error_msg"><?php echo $err;?></span>
                </label>
                <label class="l-1" for="item_category">Category
                    <input type="text" placeholder="item category" class="item" name="item_category" id="item_category" list="cat" required><br>
                    <datalist id="cat">
                        <option value="Book">
                        <option value="Computer Accessory">
                        <option value="Journal">
                        <option value="Magazine">
                        <option value="Sports Equipment">
                    </datalist>
                    <span class="error_msg"><?php echo $err2;?></span>
                </label>
                <label class="l-1" for="item_name">Item Name
                    <input type="text" placeholder="item name" class="item" name="item_name" id="item_name" required><br>
                    <span class="error_msg"><?php echo $err3;?></span>
                </label>
                <label class="l-1" for="item_quantity">Quantity
                    <input type="number" placeholder="item quanity" class="item" name="item_quantity" id="item_quanity" required><br>
                    <span class="error_msg"><?php echo $err4;?></span>
                </label>
                <label class="l-1" for="item_cost">Item Cost
                    <input type="number" placeholder="item cost" class="item" name="item_cost" id="item_cost" required><br>
                    <span class="error_msg"><?php echo $err5;?></span>
                </label>
                <label class="l-1" for="item_supplier">Supplier
                    <input type="text" placeholder="item supplier" class="item" name="item_supplier" id="item_supplier" required><br>
                    <span class="error_msg"><?php echo $err6;?></span>
                </label>
                <input class="s-button" type="submit" name="inv-submit" value="ADD" id="s-button"/><input class="back-button" id="back-button"  value="BACK"/>
            </form>
        </section>

        <section class="sup-form">
            <h2>SUPPLIER FORM</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="sup-f">
                <label class="l-2" for="supplier_id">Supplier ID
                    <input type="text" placeholder="supplier id(spp---)" class="item" name="supplier_id" id="supplier_id" required><br>
                    <span class="error_msg"><?php echo $serr ;echo $serr2;?></span>
                </label>
                <label class="l-2" for="supplier_name">Name
                    <input type="text" placeholder="supplier_name" class="item" name="supplier_name" id="supplier_name" required><br>
                    <span class="error_msg"><?php echo $serr3;?></span>
                </label>
                <label class="l-2" for="tel_no">Phone
                    <input type="number" placeholder="phone number" class="item" name="tel_no" id="tel_no" required><br>
                    <span class="error_msg"><?php echo $serr4;?></span>
                </label>
                <label class="l-2" for="item_quantity">Address
                    <input type="text" placeholder="address" class="item" name="address" id="address" required><br>
                    <span class="error_msg"><?php echo $serr5 ;?></span>
                </label>
                <input class="s-button" type="submit" name="sup-submit" value="ADD"/><input class="back-button" id="back-button"  value="BACK"/>
            </form>
        </section>


        <section class="sale-form">
            <h2>SALES FORM</h2>
            <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="sl-f" >
                <label class="l-3" for="sale_id">Sale ID
                    <input type="text" placeholder="sale id(sl---)" class="item" name="sale_id" id="sale_id" required><br>
                    <span class="error_msg"><?php echo $sserr;?></span>
                </label>
                <label class="l-3" for="mode_of_payment">Payment
                    <input type="text" placeholder="mode of payment" class="item" name="mode_of_payment" id="mode_of_payment" list="mop" required><br>
                    <datalist id="mop">
                        <option value="Cash">
                        <option value="Credit card">
                        <option value="Cheque">
                    </datalist>
                    <span class="error_msg"><?php echo $sserr3;?></span>
                </label>
                <label class="l-3" for="quantity">Quantity
                    <input type="number" placeholder="quanity" class="item" name="quantity" id="quanity" required><br>
                    <span class="error_msg"><?php echo $sserr4;?></span>
                </label>
                <label class="l-3" for="item_name">Item ID
                    <input type="text"placeholder="item name" class="item" name="item_name" id="item_name" list="items" required><br>
                    <datalist id="items">
                    
                    <?php
                        //SQL
                        $ssql="SELECT Item_name FROM inventory";
                        if($rs=sqlsrv_query($conn,$ssql)){
                            while($row=sqlsrv_fetch_array($rs,SQLSRV_FETCH_ASSOC)){
                                echo
                                "<option value='$row[Item_name]'>";
                            }
                        }else   
                            die(print_r(sqlsrv_errors()));
                        
                        
                    ?>  
                    </datalist>
                    <span class="error_msg"><?php echo $sserr5;?></span>
                </label>
                
                <input class="s-button" type="submit" name="sale-submit" value="ADD" id="s-button"/><input class="back-button" id="back-button"  value="BACK"/>
            </form>
        </section>

        <section class="ord-form">
            <h2>ORDER FORM</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="ord-f">
                <label class="l-4" for="order_id">Order ID
                    <input type="text" placeholder="order id(od---)" class="item" name="order_id" id="order_id" required><br>
                    <span class="error_msg"><?php echo $ssserr ;echo $ssserr2;?></span>
                </label>
                <label class="l-4" for="item_name">Name
                    <input type="text" placeholder="item_name" class="item" name="item_name" id="item_name" list="items" required><br>
                    <datalist id="items">
                    
                    <?php
                        //SQL
                        $ssql="SELECT Item_name FROM inventory";
                        if($rs=sqlsrv_query($conn,$ssql)){
                            while($row=sqlsrv_fetch_array($rs,SQLSRV_FETCH_ASSOC)){
                                echo
                                "<option value='$row[Item_name]'>";
                            }
                        }else   
                            die(print_r(sqlsrv_errors()));
                        
                        
                    ?>  
                    </datalist>
                    <span class="error_msg"><?php echo $ssserr3;?></span>
                </label>
                <label class="l-4" for="quantity">Quantity
                    <input type="number" placeholder="quantity" class="item" name="quantity" id="quantity" required><br>
                    <span class="error_msg"><?php echo $ssserr4;?></span>
                </label>
                <label class="l-4" for="supplier_name">Supplier
                    <input type="text" placeholder="supplier" class="item" name="supplier_name" id="supplier_name" list="supp" required><br>
                    <datalist id="supp">
                    <?php
                        //SQL
                        $ssql1="SELECT s_name FROM suppliers";
                        if($rs1=sqlsrv_query($conn,$ssql1)){
                            while($row1=sqlsrv_fetch_array($rs1,SQLSRV_FETCH_ASSOC)){
                                echo"<option value='$row1[s_name]'>";
                            }
                        }else   
                            die(print_r(sqlsrv_errors())); 
                    ?>  
                    </datalist>
                    <span class="error_msg"><?php echo $ssserr5 ;?></span>
                </label>
                
                <input class="s-button" type="submit" name="ord-submit" value="ADD"/><input class="back-button" id="back-button"  value="BACK"/>
            </form>
        </section>

        <section class="clo-form">
            <h2>CLIENT ORDER FORM</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="clo-f">
                <label class="l-5" for="clo_id">CLO ID
                    <input type="text" placeholder="clo id(clo---)" class="item" name="clo_id" id="clo_id" required><br>
                    <span class="error_msg"><?php echo $sssserr ;echo $sssserr2;?></span>
                </label>
                <label class="l-5" for="client_id">Client ID
                    <input type="text" placeholder="P--/----/----" class="item" name="client_id" id="client_id"required><br>
                    <span class="error_msg"><?php echo $sssserr3;?></span>
                </label>
                <label class="l-5" for="client_name">Name
                    <input type="text" placeholder="name" class="item" name="client_name" id="client_name" required><br>
                    <span class="error_msg"><?php echo $sssserr4;?></span>
                </label>
                <label class="l-5" for="client_email">Email
                    <input type="email" placeholder="email" class="item" name="client_email" id="client_email"required><br>
                    <span class="error_msg"><?php echo $sssserr5 ;?></span>
                </label>
                <label class="l-5" for="order_id">Order ID
                    <input type="text" placeholder="order id(od---)" class="item" name="order_id" id="order_id" required><br>
                    <span class="error_msg"><?php echo $sssserr6 ;echo $ssserr2;?></span>
                </label>
                <label class="l-5" for="item_name">Item Name
                    <input type="text" placeholder="item_name" class="item" name="item_name" id="item_name" list="items" required><br>
                    <datalist id="items">
                    
                    <?php
                        //SQL
                        $ssql="SELECT Item_name FROM inventory";
                        if($rs=sqlsrv_query($conn,$ssql)){
                            while($row=sqlsrv_fetch_array($rs,SQLSRV_FETCH_ASSOC)){
                                echo
                                "<option value='$row[Item_name]'>";
                            }
                        }else   
                            die(print_r(sqlsrv_errors()));
                        
                        
                    ?>  
                    </datalist>
                    <span class="error_msg"><?php echo $sssserr7;?></span>
                </label>
                <label class="l-5" for="quantity">Quantity
                    <input type="number" placeholder="quantity" class="item" name="quantity" id="quantity" required><br>
                    <span class="error_msg"><?php echo $sssserr8;?></span>
                </label>
                <label class="l-5" for="supplier_name">Supplier
                    <input type="text" placeholder="supplier" class="item" name="supplier_name" id="supplier_name" list="supp" required><br>
                    <datalist id="supp">
                    <?php
                        //SQL
                        $ssql1="SELECT s_name FROM suppliers";
                        if($rs1=sqlsrv_query($conn,$ssql1)){
                            while($row1=sqlsrv_fetch_array($rs1,SQLSRV_FETCH_ASSOC)){
                                echo"<option value='$row1[s_name]'>";
                            }
                        }else   
                            die(print_r(sqlsrv_errors())); 
                    ?>  
                    </datalist>
                    <span class="error_msg"><?php echo $sssserr9 ;?></span>
                </label>
                
                <input class="s-button-l" type="submit" name="clo-submit" value="ADD"/><input class="back-button-l" id="back-button"  value="BACK"/>
            </form>
        </section>
</html>