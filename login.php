<?php
require_once 'connect.php';
 
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT user_type, userID, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $user_type, $userID, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['user_type'] = $user_type;
                            $_SESSION['userID'] = $userID;                   
                            header('location: index.php');
                        } else{
                            $password_err = 'Invalid or incorrect password. Try again';
                        }
                    }
                } else{
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <!-- Login Navbar Logo -->
    <link rel="icon" href="images/favicon.jpg" type="image/ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login Page</title>
    <!-- end Login Navbar Logo -->
</head>
<body class="text-center" style="background-color: #050936;">
    <!-- Login Form-->
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <img class="mb-4" src="images/logo.jpg" alt="" width="auto" height="auto">
        <h1 style="color: white;" class="h3 mb-3 font-weight-normal">Log In</h1>
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <input class="form-control shadow-sm" type="text" name="username" placeholder="Username">
            <span class="help-block" style="color: white;"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
           <input class="form-control shadow-sm" type="password" name="password" placeholder="Password">
            <span class="help-block" style="color: white;"><?php echo $password_err; ?></span> 
        </div>
        <div class="form-group">
            <button class="btn btn-gray" type="submit" value="Login">Login</button>
            <button class="btn btn-danger" type="reset" value="Reset">Clear</button>
        </div>
    </form>
    <!-- end of Login Form -->
</body>
</html>