<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        exit();     
    }

    include '../connect.php';   
    
    $order=$_REQUEST["order"];  $order="%".$order."%";

    $sql  = "SELECT userID, username, name, last_name, email, cel_num FROM Users WHERE user_type=0
    AND username LIKE ? ORDER BY userID DESC";
    $stmt=$link->prepare($sql);
    $stmt->bind_param("s", $order);
    $stmt->execute();
    $result=$stmt->get_result();
    
    echo '<thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Phone Num</th>
            </tr>
            </thead>';
                
    if($result){                   
        while($row = mysqli_fetch_assoc($result)) {      
            $cel_num=preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $row['cel_num']);                  

            echo "<tr>    
                  <td>" . $row['userID'] . "</td>                  
                  <td>" . $row['username'] . "</td>
                  <td>" . $row['name']      . "</td>
                  <td>" . $row['last_name'] . "</td>
                  <td>" . $row['email']     . "</td>
                  <td>" . $cel_num     . "</td>
                </tr>";
        }     
    }

    $link -> close();
?>