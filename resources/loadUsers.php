<?php
    $link = mysqli_connect('localhost', 'root', 'root', 'rems');

	if ($link == false) {
	    die("No connection...". mysqli_connect_error());
	}

	$sql  = "SELECT userID, username, name, last_name, email, cel_num FROM Users WHERE user_type=0";
    $result = $link->query($sql);
    
    echo '<thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Username</th>
                <th scope="col">Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Phone Num</th>
                <th scope="col"> </th>
            </tr>
            </thead>';
                
    if($result){                   
        while($row = mysqli_fetch_assoc($result)) {                        

            echo "<tr>    
                  <td>" . $row['userID'] . "</td>                  
                  <td>" . $row['username'] . "</td>
                  <td>" . $row['name']      . "</td>
                  <td>" . $row['last_name'] . "</td>
                  <td>" . $row['email']     . "</td>
                  <td>" . $row['cel_num']     . "</td>
                  <td>
                <button onclick='setUpdateData(\"".$row['userID']."\",\"".$row['username']."\",\"".$row['name']."\",\"".$row['last_name']."\",\"".$row['email']."\",\"".$row['cel_num']."\")' 
                class='btn btn-danger'  name='updateUser' data-toggle='modal' data-target='#updateuModal'>Update</button>
                <button onclick='setRemoveData(\"".$row['userID']."\")' 
                class='btn btn-danger'  name='removeUser' data-toggle='modal' data-target='#removeuModal'>Remove</button>
                </td>
            </tr>";
        }     
    }
?>