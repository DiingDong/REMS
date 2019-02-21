<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        exit();     
	}

    include '../connect.php';

    $order=$_REQUEST["order"];  $order="%".$order."%"; 

    $sql="SELECT Units.*, Users.name, Users.last_name FROM Users RIGHT JOIN Units ON Units.userID=Users.userID 
    WHERE address LIKE ? ORDER BY unitID DESC";
	$stmt=$link->prepare($sql);
    $stmt->bind_param("s", $order);
    $stmt->execute();
    $result=$stmt->get_result();
    
    echo '<thead>
            <tr>
                <th scope="row">Image</th>
                <th scope="row">Added By</th>
                
                <th scope="row">Status</th>
                <th scope="row"">Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th scope="row">Price</th>
                <th scope="row">Listing Member</th>
                <th scope="row">End Date</th>

                <th scope="row">Due Per Month</th>
                <th scope="row">Property Type</th>
                <th scope="row">Listing Side</th>
                <th scope="row">Selling Side</th>
                <th scope="row">Area</th>

                <th scope="row">Zone</th>
                <th scope="row">Comunity</th>
                <th scope="row">Bedrooms</th>
                <th scope="row">Full Baths</th>
                <th scope="row">Half Baths</th>
                <th scope="row">Year Built</th>
                
                <th scope="row">Listing Office&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th scope="row">Directions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th scope="row">Legal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th scope="row">View</th>
                <th scope="row">Pet Friendly</th>
                
                <th scope="row">List Price</th>
                <th scope="row">Sold Price</th>                
            </tr>
            </thead>';
    
    if($result){                   
        while($row = mysqli_fetch_assoc($result)) {           

            $table_end_date=date('d/m/Y', strtotime($row['end_date']));

            if($row['status']==1){
                $status="Active";
            }else{  
                $status="Inactive";
            }  
                        
            if($row['pet_friendly']==1){
                $pet_friendly="Yes";
            }else{  
                $pet_friendly="No";
            }

            $price=preg_replace("/^(\d{3})(\d{3})(\d{3})$/", "$1-$2-$3", $row['price']);  

            $image="images/listingImages/".$row['image'];

            echo 
                "<tr>
                <td><img src='".$image."' alt='' border=3 height=100 width=120 onclick='window.open(this.src)' style='cursor: pointer;'> </img></td>
                <td>" .$row['name']." ".$row['last_name']. "</td>
                <td>" . $status    . "</td>
                <td>" . $row['address']    . "</td>          
                <td>" . $row['price']      . "</td>
                <td>" . $row['listing_member'] . "</td>
                <td>" . $table_end_date     . "</td>
                
                <td>" . $row['due_per_month']   . "</td>
                <td>" . $row['property_type']    . "</td>                  
                <td>" . $row['listing_side']  . "</td>
                <td>" . $row['selling_side']      . "</td>
                <td>" . $row['area'] . "</td>
                
                <td>" . $row['zone']    . "</td>                  
                <td>" . $row['community']  . "</td>
                <td>" . $row['bedrooms']      . "</td>
                <td>" . $row['full_baths'] . "</td>
                <td>" . $row['half_baths']     . "</td>

                <td>" . $row['year_built']    . "</td>                  
                <td>" . $row['listing_office']  . "</td>
                <td>" . $row['directions']      . "</td>
                <td>" . $row['legal'] . "</td>
                <td>" . $row['view']     . "</td>

                <td>" . $pet_friendly     . "</td>
                <td>" . $row['list_price'] . "</td>
                <td>" . $row['sold_price']     . "</td>                
                
            </tr>";
        }     
    }
    
    $link -> close();
?>