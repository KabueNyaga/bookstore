<?php 
     session_start();
 
     if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
         header("location : login.php");
     }
 
     $user=$_SESSION["username"];
 
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="entry_forms.css"/>
        <script type="text/javascript"  src="bookstore.js"></script>
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
            </div>
            <div class="nav-buttons" id="nav-button2-2" >
            <p class="button-desc">SUPPLIERS FORM</p>
            </div>
            <div class="nav-buttons" id="nav-button3-3" >
                <p class="button-desc">SALES FORM</p>
            </div>
            <div class="nav-buttons" id="nav-button4-4" >
            <p class="button-desc">ORDERS FORM</p>
            </div>
            <div class="nav-buttons" id="nav-button5-5" >
            <p class="button-desc">CLIENT ORDERS FORM</p>
            </div>
            </div>  
        </section>
        <section class="inv-form">
            <h2>INVENTORY FORM</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="inv-f">
                <label for="item_id">Item ID
                    <input type="text" placeholder="item id" class="item" name="item_id" id="item_id"><br>
                </label>
                <label for="item_category">Category
                    <input type="text" placeholder="item category" class="item" name="item_category" id="item_category" list="cat"><br>
                    <datalist id="cat">
                        <option value="Book">
                        <option value="Computer Accessory">
                        <option value="Journal">
                        <option value="Magazine">
                        <option value="Sports Equipment">
                    </datalist>
                </label>
                <label for="item_name">Item Name
                    <input type="text" placeholder="item name" class="item" name="item_name" id="item_name"><br>
                </label>
                <label for="item_quantity">Quantity
                    <input type="number" placeholder="item quanity" class="item" name="item_quanity" id="item_quanity"><br>
                </label>
                <label for="item_cost">Item Cost
                    <input type="number" placeholder="item cost" class="item" name="item_cost" id="item_cost"><br>
                </label>
                <label for="item_supplier">Supplier
                    <input type="text" placeholder="item supplier" class="item" name="item_supplier" id="item_supplier"><br>
                </label>
                <button class="s-button" type="submit">ADD</button>
            </form>
        </section>
</html>