<?php
    session_start();
    if($_SESSION['user_type']!=1){
        exit();      
    }

    include '../connect.php';
	
    $unitID=$_REQUEST["unitID"];

    $status=trim($_REQUEST["status"]);
    $address=trim($_REQUEST["address"]);
    $price=trim($_REQUEST["price"]);
    $listing_member=trim($_REQUEST["listing_member"]);
    $end_date=$_REQUEST["end_date"]; $end_date =date('Y-m-d', strtotime($end_date));

    $due_per_month=trim($_REQUEST["due_per_month"]);
    $property_type=trim($_REQUEST["property_type"]);
    $listing_side=trim($_REQUEST["listing_side"]);
    $selling_side=trim($_REQUEST["selling_side"]);
    $area=trim($_REQUEST["area"]);

    $zone=trim($_REQUEST["zone"]);
    $community=trim($_REQUEST["community"]);
    $bedrooms=trim($_REQUEST["bedrooms"]);
    $full_baths=trim($_REQUEST["full_baths"]);
    $half_baths=trim($_REQUEST["half_baths"]);

    $year_built=trim($_REQUEST["year_built"]);
    $listing_office=trim($_REQUEST["listing_office"]);
    $directions=trim($_REQUEST["directions"]);
    $legal=trim($_REQUEST["legal"]);
    $view=trim($_REQUEST["view"]);

    $pet_friendly=trim($_REQUEST["pet_friendly"]);
    $list_price=trim($_REQUEST["list_price"]);
	$sold_price=trim($_REQUEST["sold_price"]);
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
		$boo=FALSE;  
		
		$sql="SELECT *  FROM units WHERE unitID=?"; 
		$stmt=$link->prepare($sql);
		$stmt->bind_param("s", $unitID);
		$stmt->execute();
		$res=$stmt->get_result();
		if($res->num_rows>0){
			$row=$res->fetch_assoc();
		}
		
        if ($status!=$row["status"]){
			if($status==1){
				$sql = "UPDATE Units SET status=1 WHERE unitID=?";
			}else{
				$sql = "UPDATE Units SET status=0 WHERE unitID=?";
			}
			$stmt=$link->prepare($sql);
			$stmt->bind_param("s", $unitID);   
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($address!=$row["address"]){
			$sql = "UPDATE Units SET address=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $address, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($price!=$row["price"]){
			$sql = "UPDATE Units SET price=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $price, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($listing_member!=$row["listing_member"]){
			$sql = "UPDATE Units SET listing_member=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $listing_member, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($end_date!=$row["end_date"]){
			$sql = "UPDATE Units SET end_date=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $end_date, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }


        
        if ($due_per_month!=$row["due_per_month"]){
			$sql = "UPDATE Units SET due_per_month=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $due_per_month, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($property_type!=$row["property_type"]){
			$sql = "UPDATE Units SET property_type=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $property_type, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($listing_side!=$row["listing_side"]){
			$sql = "UPDATE Units SET listing_side=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $listing_side, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($selling_side!=$row["selling_side"]){
			$sql = "UPDATE Units SET selling_side=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $selling_side, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($area!=$row["area"]){
			$sql = "UPDATE Units SET area=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $area, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }

        if ($zone!=$row["zone"]){
			$sql = "UPDATE Units SET zone=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $zone, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($community!=$row["community"]){
			$sql = "UPDATE Units SET community=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $community, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($bedrooms!=$row["bedrooms"]){
			$sql = "UPDATE Units SET bedrooms=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $bedrooms, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($full_baths!=$row["full_baths"]){
			$sql = "UPDATE Units SET full_baths=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $full_baths, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($half_baths!=$row["half_baths"]){
			$sql = "UPDATE Units SET half_baths=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $half_baths, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }



        if ($year_built!=$row["year_built"]){
			$sql = "UPDATE Units SET year_built=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $year_built, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($listing_office!=$row["listing_office"]){
			$sql = "UPDATE Units SET listing_office=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $listing_office, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($directions!=$row["directions"]){
			$sql = "UPDATE Units SET directions=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $directions, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($legal!=$row["legal"]){
			$sql = "UPDATE Units SET legal=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $legal, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($view!=$row["view"]){
			$sql = "UPDATE Units SET view=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $view, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        

		
        if ($pet_friendly!=$row["pet_friendly"]){
			if($pet_friendly==1){
				$sql = "UPDATE Units SET pet_friendly=1 WHERE unitID=?";
			}else{
				$sql = "UPDATE Units SET pet_friendly=0 WHERE unitID=?";
			}			
			$stmt=$link->prepare($sql);
			$stmt->bind_param("s", $unitID);      
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($list_price!=$row["list_price"]){
			$sql = "UPDATE Units SET list_price=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $list_price, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
        }
        if ($sold_price!=$row["sold_price"]){
			$sql = "UPDATE Units SET sold_price=? WHERE unitID=?";
			$stmt=$link->prepare($sql);
			$stmt->bind_param("ss", $sold_price, $unitID);        
			if(!$stmt->execute()){
				$message="Failed to save changes<br>";
			}else{
				$boo=TRUE;
			}
		}     
		
		if(isset($_FILES['image'])){			

            if (($_FILES["image"]["type"] == "image/gif" || $_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/png" || $_FILES["image"]["type"] == "image/jpeg") 
            && ($_FILES["image"]["size"] < 5000000000)){

				$dir=realpath(dirname(__FILE__));
				
				if(!empty($row['image'])){	unlink("$dir/../images/listingImages/".$row['image']);	}

				$unq=uniqid();
                $image=$unq.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "$dir/../images/listingImages/".$unq.basename($_FILES['image']['name']));
				
				$sql = "UPDATE Units SET image=? WHERE unitID=?";
				$stmt=$link->prepare($sql);
				$stmt->bind_param("ss", $image, $unitID);        
				if(!$stmt->execute()){
					$message="Failed to save changes<br>";
				}else{
					$boo=TRUE;
				}
			}			
        }
                     
        if(empty($message) && $boo==TRUE){
			$message="success";
		}else if($boo==FALSE){
			$message="No changes";
		}
    }

    echo $message;
    $link -> close();
?>