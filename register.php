<?php
require_once 'connect.php';

$name = "";
$last_name = "";
$email = "";
$cel_num = "";
$username = "";
$password = "";
$confirm_password = "";
$master_password = "";
$hashed_password = "1234";//Master password


$name_err = "";
$last_name_err = "";
$email_err = "";
$cel_num_err = "";
$username_err = "";
$password_err = "";
$confirm_password_err = "";
$master_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT userID FROM users WHERE username = ?";   
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }

    if(empty(trim($_POST['name']))) {
        $name_err = "Required Field";
    } else {
        $name = trim($_POST['name']);
    }
    

    if (empty(trim($_POST['last_name']))) {
        $last_name_err = "Required Field";
    } else {
        $last_name = trim($_POST['last_name']);
    }

    if(empty(trim($_POST['email']))) {
        $email_err = "Email required";
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)<10){
            $email_err="Invalid email format<br>";
    }
    $email = trim($_POST['email']);

    if(empty(trim($_POST['cel_num']))) {
        $cel_num_err = "Required Field";
    }else if(preg_match("/[^0-9]/", $cel_num) || strlen($cel_num)!=10){
            $cel_num_err="Phone number must have 10 digits<br>";
    }
    $cel_num = trim($_POST['cel_num']);

    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password";     
    }else if(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    }else{
        $password = trim($_POST['password']);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password';
    }else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match';
        }
    }

    if(empty(trim($_POST['master_password']))){
        $master_password_err = "Please enter the password";     
    }else if(password_verify($_POST['master_password'], $hashed_password)){
        $master_password_err = 'Invalid or incorrect password. Try again';
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && !empty($master_password_err)){
        
        $sql = "INSERT INTO users(user_type, username, password, name, last_name, email, cel_num) VALUES (1, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_name, $param_last_name, $param_email, $param_cel_num);
            
            $param_email = $email;
            $param_cel_num = $cel_num;
            $param_name = $name;
            $param_last_name = $last_name;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_BCRYPT); 
            
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Something went wrong. Try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en_US">
<head>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="stylesheet" type="text/css" href="css/login.css ">
    <link rel="icon" href="images/favicon.jpg" type="image/ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <meta charset="utf-8">
    <title>Registration</title>
</head>
<body class="text-center" style="background-color: #050936;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-signin">
        <img class="mb-4" src="images/logo.jpg" alt="" width="auto" height="auto">
        <h1 style="color: white;" class="h3 mb-3 font-weight-normal">Registration</h1>

        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <input placeholder="Name" type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            <span class="help-block" style="color: white;"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
            <input placeholder="Last Name" type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
            <span class="help-block" style="color: white;"><?php echo $last_name_err; ?></span>
        </div>  
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <input placeholder="User Name" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block" style="color: white;"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <input placeholder="e-mail" type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <span style="color: white;" class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($cel_num_err)) ? 'has-error' : ''; ?>">
            <input placeholder="Phone number" type="number" name="cel_num" class="form-control" value="<?php echo $cel_num; ?>">
            <span style="color: white;" class="help-block"><?php echo $cel_num_err; ?></span>
        </div>    
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input placeholder="Password" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span style="color: white;" class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <input placeholder="Confirm Password" type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
            <small style="color: white;">both passwords must be the same</small>
        </div>
        <br>
        <div class="form-group <?php echo (!empty($master_password_err)) ? 'has-error' : ''; ?>">
            <input placeholder="Access password" type="password" name="master_password" class="form-control" value="<?php echo $master_password; ?>">
            <span class="help-block"><?php echo $master_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Register">
            <input type="reset" class="btn btn-default" value="Clear">
        </div>
        <a href="adminUsers.php">Return to Control Panel</a>
    </form>

</body>
</html>
<?php
    sleep(1);
?>