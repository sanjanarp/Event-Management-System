<?php
  include "connection.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
  

    $sql="SELECT * from `user_info`.`user` where email='".$email."' AND password='".$password."' ";
    $result = mysqli_query($data,$sql);
    
    $id = 0;
    $phone_no = 0;
    $name = "";
    $usertype = "";
    while($row = mysqli_fetch_array($result)){
    $id = $row["id"];
    $phone_no = $row["phone_number"];
    $name = $row["name"];
    $usertype = $row["usertype"];
    }
    
    if($usertype=="user"){
        $_SESSION["email"]=$email;
        $_SESSION['id'] = $id;
        $_SESSION['phone_no'] = $phone_no;
        $_SESSION['name'] = $name;
        $_SESSION['password'] = $password;
        header("location:users/index.php");
    }
    elseif($usertype=="admin"){
        $_SESSION["email"]=$email;
        header("location:admin/index.php");
     }
     else {
        
         $incorrect = true;
        
    }

    
}

 
?>