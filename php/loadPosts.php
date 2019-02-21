<?php
    
    session_start();
    if(!isset($_SESSION['userID'])){
        exit();
    }
     
    include '../connect.php';   
    
    $count=$_REQUEST["count"];
	$sql = "SELECT Posts.*, Users.name, Users.last_name FROM Posts LEFT JOIN Users ON Posts.userID=Users.userID ORDER BY post_time DESC LIMIT 0, ?";
    $stmt=$link->prepare($sql);
    $stmt->bind_param("s", $count);
    $stmt->execute();
    $result=$stmt->get_result();

    echo "<h3 class='title' style='padding-bottom: 15px;'>Messages</h3>";

    if($result){                   
        while($row = mysqli_fetch_assoc($result)){
            if(!empty($row["name"]) || !empty($row["last_name"])){
                $name=$row["name"]." ".$row["last_name"];
            }else{
                $name="User deleted";
            }

            $message=message($row["message"]);
            
            $post_time=date('d/m/Y H:i:s', strtotime($row['post_time']));

            echo
            "<div class='card' style='width: 40rem;'>
                <div class='card-header'>
                    <h5 class='card-title'>".$row["subject"]."</h5>
                    <h6 class='card-title'>".$name." - ".$post_time."</h6>
                </div>
                <div class='card-body'>
                    <p>".$message."</p>
                </div>
            </div>
            <br>";
        }
    }
    
    $link -> close();

    function message($msg){
        $out="";
        while(preg_match("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", $msg, $url)) {
        
            $out=$out.substr($msg, 0, strpos($msg, $url[0]));
            $msg=substr($msg, strpos($msg, $url[0])+strlen($url[0]), strlen($msg));
            $str=preg_replace("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/",
                 "<a href=".$url[0].">".$url[0]."</a> ", $url[0], 1);
            $out=$out.$str;
        
        }
        return $out.$msg;
      }  
?>