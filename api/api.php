<?php
require_once('config.php');

header("content-type:   application/json; charset=UTF-8");
session_start();
$sid =session_id();

function access(){
    $servername = "localhost";
    $username = "root";
    $password = "";

      $conn = new PDO("mysql:host=$servername;dbname=amirkabir_db", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $input = json_decode($_GET["users"],true);
    if($input["access"]=="modir"){
       
        $stmt = $conn->prepare("SELECT id, username, password FROM tbl_admin where username = :username and password = :password and isadmin = 1");
        $stmt->bindParam(':username', $input['username']);
        $stmt->bindParam(':password', $input['password']);
        $stmt->execute();
    
        // set the resulting array to associative
      
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
       if($result1) {
        $data = json_encode(["message" =>"true"]);
       }
       else{
        $data = json_encode(["message" =>"false"]);
       }
       
        return    $data; 
    
    }
    elseif($input["access"]=="dabir"){

        $stmt = $conn->prepare("SELECT id, username, password FROM tbl_admin where username = :username and password = :password and isadmin = 0");
        $stmt->bindParam(':username', $input['username']);
        $stmt->bindParam(':password', $input['password']);
        $stmt->execute();
    
        // set the resulting array to associative
      
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
       if($result1) {
        $data = json_encode(["message" =>"true"]);
       }
       else{
        $data = json_encode(["message" =>"false"]);
       }
       
        return    $data; 

    }
    elseif($input["access"]=="honarjo"){
        $stmt = $conn->prepare("SELECT id, username, password FROM tbl_user where username = :username and password = :password");
        $stmt->bindParam(':username', $input['username']);
        $stmt->bindParam(':password', $input['password']);
        $stmt->execute();
    
        // set the resulting array to associative
      
        $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
       if($result1) {
        $data = json_encode(["message" =>"true"]);
       }
       else{
        $data = json_encode(["message" =>"false"]);
       }
       return    $data; 
    
    }
        

     return $data; 

       }
       //////////////////////////////////////////////////////


if($_GET["users"]){
    $stmt = $conn->prepare("SELECT t FROM tbl_ip where sid = :sid  and ban = 0");
    $stmt->bindParam(':sid', $sid);
   
    $stmt->execute();
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT t FROM tbl_ip where sid = :sid ");
    $stmt->bindParam(':sid', $sid);
   
    $stmt->execute();
      $insertok =  $stmt->fetch(PDO::FETCH_ASSOC);
    // set the resulting array to associative

  

   if($result1) {
    
    $stmt = $conn->prepare("update tbl_ip set t = t + 1 where sid = :sid and ban = 0");
    $stmt->bindParam(':sid', $sid);
   
    $stmt->execute();

    $stmt = $conn->prepare("SELECT t FROM tbl_ip where sid = :sid  and ban = 0");
    $stmt->bindParam(':sid', $sid);
   
    $stmt->execute();
   $v = $stmt->fetchColumn();


    if($v>5){
        $stmt = $conn->prepare("update tbl_ip set ban = 1 where sid = :sid ");
    $stmt->bindParam(':sid', $sid);
   
    $stmt->execute();


        $data = json_encode(["ip" =>$v , "message" => "you are ban"]);
         echo $data; 
    }

    echo access();
}
   elseif($insertok == null){
    $sql = "INSERT INTO tbl_ip (sid, t)
    VALUES ('$sid', '1')";
    // use exec() because no results are returned
    $conn->exec($sql);

   

    echo access();
    
    // foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    //   echo $v;
    // }

 
   


   }
   else{
    $data = json_encode(["message" =>"you are ban"]);
    echo $data; 
}
   }


   








?>