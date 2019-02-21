<?php
	session_start();
    if($_SESSION['user_type']!=1){
        exit();      
    }

    include '../connect.php';	

	$unitID=trim($_REQUEST["id"]);

	$sql="SELECT image FROM Units WHERE unitID=?";
	$stmt=$link->prepare($sql);
    $stmt->bind_param("s", $unitID);
    $stmt->execute();
	$result=$stmt->get_result();
		
	$sql="DELETE FROM units WHERE unitId=?"; 
	$stmt=$link->prepare($sql);
	$stmt->bind_param("s", $unitID);
	if($stmt->execute()){
		if($result){                   
			$row = mysqli_fetch_assoc($result);
			$dir=realpath(dirname(__FILE__));

			if(!empty($row['image'])){	unlink("$dir/../images/listingImages/".$row['image']);}
		}
		echo "success";
	}else{
		echo $stmt->error;
	}
	mysqli_stmt_close($stmt);
	
    $link -> close();
?>
