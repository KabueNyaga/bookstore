<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        $usr=trim($_POST["username"]);
        $param=array($usr);

        if($stmt = sqlsrv_prepare($conn, $sql,$param)){
            if(sqlsrv_execute($stmt)){
                if(sqlsrv_has_rows($stmt)){
                    $username_err = "This username is already taken !";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password !";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters !";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password !";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match !";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $date=date('Y/m/d H:i:s');
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, pass, created_at) VALUES (?, ?,'$date')";
        $passhash=password_hash($password,PASSWORD_DEFAULT);
        $params=array($username,$passhash,$date);
        
        $stmt=sqlsrv_prepare( $conn,$sql,$params);
        if(sqlsrv_execute($stmt)){
            header("location:login.php");
            sqlsrv_close($conn);
        }
        }
        sqlsrv_free_stmt($stmt);
    }
    
    
    // Close connection
    sqlsrv_close($conn);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="reg_user.css">
</head>
<body>
    <div class="wrapper">
        <img src="bookstore-lg.jpg"> 
        <p class="welcome-stmt">Please fill this form to create an account.</p>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="reg-form">
                <label for="username"><span class="labels">Username</span>
                    <input required type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?> "><br>
                    <span class="invalid-feedback"><?php echo $username_err; ?></span><br>
                </label>

                <label for="password"><span class="labels">Password</span>
                    <input required type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>"><br>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span><br>
                </label>
       
                <label><span class="labels">Confirm Password</span>
                    <input required type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"><br>
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><br>
                </label>

                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
 
        </form>
    </div>    
</body>
</html>
