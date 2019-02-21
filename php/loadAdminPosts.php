<?php
    session_start();
    if($_SESSION['user_type']!=1){
        exit();
    }

    include '../connect.php';   

    $order=$_REQUEST["order"];  $order="%".$order."%";   

	$sql = "SELECT Posts.*, Users.userID, Users.name, Users.last_name FROM Posts LEFT JOIN Users ON Posts.userID=Users.userID 
    WHERE subject LIKE ? ORDER BY post_time DESC";
    $stmt=$link->prepare($sql);
    $stmt->bind_param("s", $order);
    $stmt->execute();
    $result=$stmt->get_result();

    echo
    '<thead class="thead-light">
        <td><strong>Post ID</strong></td>
        <td><strong>Subject</strong></td>
        <td><strong>Message</strong></td>
        <td><strong>Post Time</strong></td>
        <td><strong>Posted By</strong></td>
        <td><strong>User ID</strong></td>
        <td><strong>Options</strong></td>
    </thead>';

    if($result){                   
        while($row = mysqli_fetch_assoc($result)){
            if(!empty($row["name"]) || !empty($row["last_name"])){
                $name=$row["name"]." ".$row["last_name"];
            }else{
                $name="-";
            }

            if(!empty($row["userID"])){
                $userID=$row["userID"];
            }else{
                $userID="NULL";
            }

            echo 
            "<tr>    
                <td>" . $row['postID'] . "</td>                  
                <td>" . $row['subject'] . "</td>
                <td>" . $row['message']      . "</td>
                <td>" . $row['post_time'] . "</td>
                <td>" . $name. "</td>
                <td>" . $userID   . "</td>
                <td>
                <button onclick='setRemoveData(\"".$row['postID']."\")' 
                class='btn btn-danger'  name='removeUser' data-toggle='modal' data-target='#removeuModal'>Remove</button>
                </td>
            </tr>";
        }
    }
    
    $link -> close();
?>