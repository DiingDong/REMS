<?php
    session_start();
    if($_SESSION['user_type']!=1){
        exit();      
    }

    include '../connect.php';    

    $name=trim($_REQUEST["name"]);
    $last_name=trim($_REQUEST["lastname"]);
    $username=trim($_REQUEST["user"]);
    $password=trim($_REQUEST["pass"]);
    $passVer=trim($_REQUEST["passVer"]);
    $email=trim($_REQUEST["email"]);
    $cel_num=trim($_REQUEST["celNum"]);

    $message="";

    //The user requirements are met here
    if (empty($username) || empty($password) || empty($name) || empty($last_name) || empty($email) || empty($cel_num)){
        $message="Fill the required fields";
    }else{
        if(!preg_match("/^[A-Za-z]+((\s)?((\')?([A-Za-z])+))*$/", $name)){
            $message="Name is not valid<br>";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email)<10){
            $message=$message."Use proper email format<br>";
        }
        if(preg_match("/[^0-9]/", $cel_num) || strlen($cel_num)!=10){
            $message=$message."Phone number must have 10 digits<br>";
        }
        if(strlen($password)<6){
            $message=$message."Password must have more than 6 characters<br>";
        }else if($password!=$passVer && empty($message)){
            $message=$message."Passwords must be equal";
        }        
    }
    
    if(empty($message)){
        $sql="SELECT userID FROM users WHERE username=?"; 
		$stmt=$link->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result=$stmt->get_result();
		if($result){      
			if($row = mysqli_fetch_assoc($result)){
				echo "Username already taken";
				exit();
			}
		}
    }
    
    if (empty($message)) {
        $hash_password=password_hash($password, PASSWORD_BCRYPT);

        $sql="INSERT INTO users (user_type, username, password, name, last_name, email, cel_num) 
            VALUES (0, ?, ?, ?, ?, ?, ?)"; 
                
        $stmt=$link->prepare($sql);
        $stmt->bind_param("ssssss", $username, $hash_password, $name, $last_name, $email, $cel_num);        
        if($stmt->execute()){
            $message="success";
        }else{
            $message="Failed " . $stmt->error;
        }
    }

    echo $message;
    $link -> close();
?>