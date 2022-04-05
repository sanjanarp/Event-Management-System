<!DOCTYPE html>

<?php
 include('../connection.php');
 $id = $_SESSION['id'];
 $name ="";
 $email ="";
 $phone ="";
 $password ="";
 $sql_sel = "SELECT * FROM `user` where id= $id";
 $res = mysqli_query($data, $sql_sel);
 while($row = mysqli_fetch_array($res)){
     $name = $row["name"];
     $email = $row["email"];
     $phone = $row["phone_number"];
     $password = $row["password"];
 }


?>


<html>
<head>
<title>Edit Profile Page</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<center>
<div class="box">

<input type="file" id="file" name="image" >
<img src="images/avtar.jpg" width="100%" height="100%">

<form action="" method = "post">
<input type="text" placeholder="User Name" name="name" value="<?php echo $name; ?>" required>
<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
<input type="Email" placeholder="Email ID" name="email" value="<?php echo $email; ?>" required >
<?php if (isset($email_error)): ?>
            <span><?php echo $email_error; ?></span>
           <?php endif ?>
</div>
<div <?php if (isset($phone_error)): ?> class="form_error" <?php endif ?> >

<input type="text" name="phone_number" placeholder="Phone Number"  value="<?php echo $phone; ?>" required>
<?php if (isset($phone_error)): ?>
  <span><?php echo $phone_error; ?></span>
<?php endif ?>
</div>
<div class="pass">
          <input type="password" name="password" id="password" placeholder="Enter a password" required>
          <!-- <i><span class="material-icons" id="visibilityBtn">
            visibility
            </span></i> </div> -->
<button class = "btn btn-primary" name="update">Update</button>
<a href="profile.php"class = "btn btn-primary" >Cancel</a>
</form>
</div>
</center>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>        
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 

if(isset($_POST["update"])){
    $name1 =  isset($_POST['name']) ? $_POST['name'] : '';
    $email1 =isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number1 = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    if($email == $email1 && $phone== $phone_number1){
        $sql_update = "UPDATE `user_info`.`user` set `name`= '$name1' ,`usertype`='$usertype1'   where `id` = '$user_id' ";
        $result = mysqli_query($data, $sql_update);
        if($result)
      {
        echo "<script>alert('User information updated successfully!');</script>";
        echo "<script> window.location = 'profile.php'</script>";
      }
      } else{
    $sql_email="SELECT * FROM `user` WHERE `email`= '$email1'";
    $sql_phone="SELECT * FROM `user` WHERE `phone_number`= '$phone_number1'";
    $db_email = mysqli_query($data, $sql_email);
    $db_phone = mysqli_query($data, $sql_phone);
  
    if( $email!= $email1 && mysqli_num_rows($db_email)!=0){
        $email_error = "Email already taken";
        echo "<script>alert('$email_error');</script>";
        echo "<script> window.location = 'profile.php'</script>";
        unset($email_error);
    }
   else if($phone!= $phone_number1 && mysqli_num_rows($db_phone)!=0){
      $phone_error = "Phone number already taken";
      echo "<script>alert('$phone_error');</script>";
      echo "<script> window.location = 'profile.php'</script>";
      unset($phone_error);
     } else{
    $sql_update = "UPDATE `user_info`.`user` set `name`= '$name1' , `email`= '$email1', `phone_number` = '$phone_number1' where `id` = '$id' ";
    $result = mysqli_query($data, $sql_update);
    if($result)
  {
    echo "<script>alert('User information updated successfully!');</script>";
    echo "<script> window.location = '../login.php'</script>";
  }
   
   }
  }
   $data->close();
}



?>


<style>
    body{
        background-image: linear-gradient(to right top, #eceaf8, #d9daf7, #c1cbf6, #a3bef6, #7db2f5);
    }
    .box{
    box-sizing: border-box;
    width: 360px;
    height: 600px;
    border-radius: 5px;
    border:2px solid #3498db;
    background-color: rgba(255,255,255,0.7);
    margin-top: 50px;
    overflow: hidden;
    }
    
    img{
    box-sizing: border-box;
    width: 100px;
    height: 100px;
    margin:20px 35% ;
    border-radius:50%;
    border:5px solid #0082e6;
    padding: 3px;
    background-color: white;
    overflow: hidden;
 }
    hr{
    width:500px;
    line-height:20px;
    margin:10px 10px 10px 10px;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"] {
    display: block;
    box-sizing: border-box;
    color: black;
    margin-bottom: 30px;
    padding: 4px;
    width: 220px;
    height: 32px;
    border: none;
    border-bottom: 1px solid #0082e6;
    font-family: 'Arial', sans-serif;
    font-weight: 400;
    font-size: 15px;
    background: none;
    }
    input[type="text"]{
    margin-top: 25px;
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
    color: black;
    background: white;
    border-top: none;
    }
    
    input[type="file"]{
    display:none;
    }
    </style>
</body>
</html>