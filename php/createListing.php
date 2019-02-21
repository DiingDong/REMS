<?php
    session_start();
    if($_SESSION['user_type']!=1){
        exit();      
    }

    $link = mysqli_connect('localhost', 'root', 'root', 'rems');

	if ($link == false) {
	    die("No connection...". mysqli_connect_error());
    }
    
    $userID=$_SESSION["userID"];

    $status=trim($_POST["status"]);
    $address=trim($_POST["address"]);
    $price=trim($_POST["price"]);
    $listing_member=trim($_POST["listing_member"]);
    $end_date=$_POST["end_date"]; $end_date =date('Y-m-d', strtotime($end_date));

    $due_per_month=trim($_POST["due_per_month"]);
    $property_type=trim($_POST["property_type"]);
    $listing_side=trim($_POST["listing_side"]);
    $selling_side=trim($_POST["selling_side"]);
    $area=trim($_POST["area"]);

    $zone=trim($_POST["zone"]);
    $community=trim($_POST["community"]);
    $bedrooms=trim($_POST["bedrooms"]);
    $full_baths=trim($_POST["full_baths"]);
    $half_baths=trim($_POST["half_baths"]);

    $year_built=trim($_POST["year_built"]);
    $listing_office=trim($_POST["listing_office"]);
    $directions=trim($_POST["directions"]);
    $legal=trim($_POST["legal"]);
    $view=trim($_POST["view"]);

    $pet_friendly=trim($_POST["pet_friendly"]);
    $list_price=trim($_POST["list_price"]);
    $sold_price=trim($_POST["sold_price"]);
    $image="";

    $message="";         

    //The user requirements are met here
    if(empty($address) || empty($price) || empty($listing_member) || 
    empty($due_per_month) || empty($property_type) || empty($listing_side) || empty($selling_side) || empty($area) || 
    empty($zone) || empty($community) || empty($bedrooms) || empty($full_baths) || empty($half_baths) || 
    empty($year_built) || empty($listing_office) || empty($directions) || empty($legal) || empty($view) || 
    empty($list_price) || empty($sold_price)){
        $message="Fill all the required fields";
    }else{
        if(!preg_match("/^[A-Za-z]+((\s)?((\')?([A-Za-z])+))*$/", $listing_member)){
            $message="Listing Member must be name<br>";
        }
        if(!preg_match("/^[A-Za-z]+((\s)?((\')?([A-Za-z])+))*$/", $listing_side)){
            $message=$message."Listing Side must be name<br>";
        }
        if(!preg_match("/^[A-Za-z]+((\s)?((\')?([A-Za-z])+))*$/", $selling_side)){
            $message=$message."Selling Side must be name<br>";
        }
        if(preg_match("/[^0-9]/", $price) || strlen($price)>9){
            $message="Price must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $due_per_month) || strlen($due_per_month)>9){
            $message="Due_per_month must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $bedrooms) || strlen($bedrooms)>2){
            $message="Bedrooms must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $full_baths) || strlen($full_baths)>2){
            $message="Full Baths must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $half_baths) || strlen($half_baths)>2){
            $message="Half Baths must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $year_built) || strlen($year_built)!=4){
            $message="Year Built must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $list_price) || strlen($list_price)>9){
            $message="List Price must be numeric<br>";
        }
        if(preg_match("/[^0-9]/", $sold_price) || strlen($sold_price)>9){
            $message="Sold be numeric<br>";
        }
    }
    
    if (empty($message)) {
        if(isset($_FILES['image'])){
            if (($_FILES["image"]["type"] == "image/gif" || $_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/png" || $_FILES["image"]["type"] == "image/jpeg") 
            && ($_FILES["image"]["size"] < 5000000000)){
                $dir=realpath(dirname(__FILE__));
                $unq=uniqid();
                $image=$unq.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "$dir/../images/listingImages/".$unq.basename($_FILES['image']['name']));
            }
        }

        $sql="INSERT INTO units (status, address, price, listing_member, end_date, 
            due_per_month, property_type, listing_side, selling_side, area, 
            zone, community, bedrooms, full_baths, half_baths, 
            year_built, listing_office, directions, legal, view,
            pet_friendly, list_price, sold_price, image, userID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?)";
                
        $stmt=$link->prepare($sql);
        $stmt->bind_param("ssssssssss"."ssssssssss"."sssss", 
            $status, $address, $price, $listing_member, $end_date, 
            $due_per_month, $property_type, $listing_side, $selling_side, $area, 
            $zone, $community, $bedrooms, $full_baths, $half_baths, 
            $year_built, $listing_office, $directions, $legal, $view, 
            $pet_friendly, $list_price, $sold_price, $image, $userID);  
                  echo $link->error;
        if($stmt->execute()){
            $message="success";
        }else{
            $message="Failed " . $stmt->error;
        }
    }

    echo $message;
    $link -> close();
?>