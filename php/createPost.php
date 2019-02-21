<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        exit();   
    }

    include '../connect.php'; 
    
    date_default_timezone_set('America/Mexico_City');       

    $userID=$_SESSION["userID"];

    $subject=trim($_REQUEST["subject"]);
    $message=trim($_REQUEST["message"]);;
    $post_time=date('Y-m-d H:i:s', time());


    $msg="";

    //The user requirements are met here
    if (empty($subject) || empty($message)){
        $msg="Message and title can't be empty";
    }

    if (empty($msg)){
        $sql="INSERT INTO posts (subject, message, post_time, userID) 
            VALUES (?, ?, ?, ?)"; 
                
        $stmt=$link->prepare($sql);
        $stmt->bind_param("ssss", $subject, $message, $post_time, $userID);        
        if($stmt->execute()){
            $msg="success";
        }else{
            $msg="Failed " . $stmt->error;
        }
    }

    echo $msg;
    $link -> close();
?>