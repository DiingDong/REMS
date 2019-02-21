<?php
	session_start();
    if($_SESSION['user_type']!=1){
        exit();      
    }

    include '../connect.php';    

	$userID=trim($_REQUEST["id"]);

	$sql="UPDATE Posts SET userID=NULL WHERE userID=?"; 
	$stmt=$link->prepare($sql);
	$stmt->bind_param("s", $userID);
	if($stmt->execute()){
		$sql="DELETE FROM users WHERE userId=?"; 
		$stmt=$link->prepare($sql);
		$stmt->bind_param("s", $userID);
		if($stmt->execute()){			
			echo "success";
		}else{
			echo $stmt->error;
		}
	}
	mysqli_stmt_close($stmt);

    $link -> close();
?>
