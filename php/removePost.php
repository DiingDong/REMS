<?php
	session_start();
	if($_SESSION['user_type']!=1){
		exit();
	}

    include '../connect.php';

	$postID=$_REQUEST['postID'];

    $sql="DELETE FROM posts WHERE postID=?"; 
	$stmt=$link->prepare($sql);
	$stmt->bind_param("s", $postID);
	if($stmt->execute()){
		echo "success";
	}else{
		echo $stmt->error;
	}
	mysqli_stmt_close($stmt);

    $link -> close();
?>
