<?php
    session_start();
    if($_SESSION['user_type']!=1){
      header("location: login.php");
      exit();
    }

	require('php-pdf/fpdf.php');

	$link = mysqli_connect('localhost', 'root', 'root', 'rems');
	if ($link == false) {
	    die("No connection...". mysqli_connect_error());
    }

	$result=mysqli_query($link,"SELECT * FROM Users ORDER BY user_type DESC");
    $number_of_products=mysqli_num_rows($result);
    
    

	$pdf->Output();
	$db->close();
?>