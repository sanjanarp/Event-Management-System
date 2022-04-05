<!DOCTYPE html>
<html lang="en">
<?php
   $insert = false;
   $server = "localhost";
   $username = "root";
   $password ="";

   $connection = mysqli_connect($server, $username, $password);
   mysqli_select_db($connection, "user_info");
   if(!$connection){
       die("connection to this database failed due to" . mysqli_connect_error());
   }
  if(isset($_POST["submit"])){ 
  $name =  isset($_POST['name']) ? $_POST['name'] : '';
  $email =isset($_POST['email']) ? $_POST['email'] : '';
  $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
  $passwd =  isset($_POST['password']) ? $_POST['password'] : '';
 
  $sql_email="SELECT * FROM `user` WHERE `email`= '$email'";
  $sql_phone="SELECT * FROM `user` WHERE `phone_number`= '$phone_number'";
  $db_email = mysqli_query($connection, $sql_email);
  $db_phone = mysqli_query($connection, $sql_phone);

  if(mysqli_num_rows($db_email)!=0){
      $email_error = "Email already taken";
  }
 elseif(mysqli_num_rows($db_phone)!=0){
    $phone_error = "Phone number already taken";
   } else{
  $sql = "INSERT INTO `user`(`name`,`email`, `phone_number`,`password`, `usertype`, `dt`) VALUES ( '$name', '$email', '$phone_number','$passwd', 'user' , current_timestamp());";
  $result = mysqli_query($connection, $sql);
//  $insert = true;
if($result)
    {
      echo "<script>alert('Registration successful!');</script>";
      echo "<script> window.location = 'login.php'</script>";
    }
//header("location: login.php");
   }
  $connection->close();
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div>

    </div>
    <div class="page">
    <div class="container m-auto">
        <h3>REGISTRATION</h3>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                <hr class="mb-3">
           <label for="name"><b>Name</b></label>
           <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name" required>
           <label for="email"><b>Email Address</b></label>
           <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
           <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email" required>
           <?php if (isset($email_error)): ?>
            <span><?php echo $email_error; ?></span>
           <?php endif ?>
           </div>
           <label for="phone_number"><b>Phone Number</b></label>
           <div <?php if (isset($phone_error)): ?> class="form_error" <?php endif ?> >
           <input class="form-control" type="phone" name="phone_number" id="phone_number" placeholder="Enter phone number" required>
           <?php if (isset($phone_error)): ?>
  <span><?php echo $phone_error; ?></span>
<?php endif ?>
</div>
          <label for="password"><b>Password</b></label>
          <div class="pass">
          <input class="form-control" type="password" name="password" id="password" placeholder="Enter a password" required>
          <i><span class="material-icons" id="visibilityBtn">
            visibility
            </span></i> </div>
            <hr class="mb-3">
         <input type="submit" id="signup" name="submit" value="Sign up!">
             </div>
        </div>
        <br>
            <div>Already registered? Login <a href="login.php">here</a></div>
    </form>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
    <div>

    </div>
    <?php
   unset($email_error);
   unset($phone_error);
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript"> 

const visibilityBtn = document.getElementById("visibilityBtn");

visibilityBtn.addEventListener("click", toggleVisibility);

function toggleVisibility(){
    const password = document.getElementById("password");
    if(password.type === "password"){
        password.type = "text";
    }else {
        password.type = "password";
    }
}
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
