<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: land_page.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, pass FROM users WHERE username = ?";
        $params=array($username);
        if($stmt = sqlsrv_prepare($conn,$sql,$params)){
      
            if(sqlsrv_execute($stmt)){

                if(sqlsrv_has_rows($stmt)){                    
                    if($row=sqlsrv_fetch_array($stmt)){
                        if(password_verify(trim($password), $row['pass'])){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: land_page.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    //$login_err = "Invalid username.";
                    die(print_r(sqlsrv_errors()));
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
    
    // Close connection
    sqlsrv_close($conn);
}
?>
 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="login.css"/>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
        <div class="login-form">
            <img src="bookstore-lg.jpg"> 
            <h2 class="div-h2">WELCOME</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="l-form" method="post">
                <label for="username">
                    <ion-icon name="person"></ion-icon><input type="text" name="username" placeholder="username" required><br>
                </label>
                <label for="password">
                    <ion-icon  name="key"></ion-icon><input type="password" name="password" placeholder="password" required/><br>
                </label>
                <P class="error-msg"><?php echo $login_err; ?></P>
                <button type="submit" class="login-button">LOGIN</button><br>  
            </form>
        </div>
    </body>
</html>