<?php 
	session_start();
    if($_SESSION['user_type']!=1){
        exit();      
    }

	include '../connect.php';

	$userID=trim($_REQUEST["userID"]);
    $name=trim($_REQUEST["name"]);
    $last_name=trim($_REQUEST["lastname"]);
    $username=trim($_REQUEST["user"]);
    $password=trim($_REQUEST["pass"]);
    $passVer=trim($_REQUEST["passVer"]);
    $email=trim($_REQUEST["email"]);
    $cel_num=trim($_REQUEST["celNum"]);

	$message="";

    //The user requirements are met here
    if (empty($username) || empty($name) || empty($last_name) || empty($email) || empty($cel_num)){
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
        if(strlen($password)<6 && !empty($password)){
            $message=$message."Password must have more than 6 characters<br>";
        }else if($password!=$passVer && empty($message)){
            $message=$message."Passwords must be equal";
        }
    }
    
    if(empty($message)){
		$boo=FALSE;

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

        $sql="SELECT userID, username, password, name, last_name, email, cel_num  FROM users WHERE userID=? AND user_type=0"; 
		$stmt=$link->prepare($sql);echo $link->error;
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $res=$stmt->get_result();
        if($res->num_rows>0){
			$row=$res->fetch_assoc();
		}
		
		if ($username!=$row["username"]){
			$sql = "UPDATE users SET username=? WHERE userID=? AND user_type=0";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $username, $userID);        
			if(!$stmt->execute()){
				$message="Failed to change Username<br>";
			}else{
				$boo=TRUE;
			}
		}		
		if (!empty($password)){
			$hash_password=password_hash($password, PASSWORD_BCRYPT);

			$sql = "UPDATE users SET password=? WHERE userID=? AND user_type=0";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $hash_password, $userID);        
			if(!$stmt->execute()){
				$message=$message."Failed to change Password<br>";
			}else{
				$boo=TRUE;
			}
		}
		if ($name!=$row["name"]){
			$sql = "UPDATE users SET name=? WHERE userID=? AND user_type=0";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $name, $userID);        
			if(!$stmt->execute()){
				$message=$message."Failed to change Name<br>";
			}else{
				$boo=TRUE;
			}
		}		
		if ($last_name!=$row["last_name"]){
			$sql = "UPDATE users SET last_name=? WHERE userID=? AND user_type=0";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $last_name, $userID);        
			if(!$stmt->execute()){
				$message=$message."Failed to change Last Name<br>";
			}else{
				$boo=TRUE;
			}
		}
		if ($email!=$row["email"]){
			$sql = "UPDATE users SET email=? WHERE userID=? AND user_type=0";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $email, $userID);        
			if(!$stmt->execute()){
				$message=$message."Failed to change Email<br>";
			}else{
				$boo=TRUE;
			}
		}
		if ($cel_num!=$row["cel_num"]){
			$sql = "UPDATE users SET cel_num=? WHERE userID=? AND user_type=0";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $cel_num, $userID);        
			if(!$stmt->execute()){
				$message=$message."Failed to change Phone Number<br>";
			}else{
				$boo=TRUE;
			}
		}
		
		if(empty($message) && $boo==TRUE){
			$message="success";
		}else if($boo==FALSE){
			$message="No changes";
		}
	}	
    
	echo $message;
    $link -> close();
?>