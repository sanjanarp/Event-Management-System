<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="page">
    <div class="container m-auto">
        <h3>LOGIN</h3>
        <form action="" method="POST">
            <div class="row">
                <div class="col">
                <hr class="mb-3">
           <label for="email"><b>Email Address</b></label>
           <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email" required> 
          <label for="password"><b>Password</b></label>
          <div class="pass">
          <input class="form-control" type="password" name="password" id="password" placeholder="Enter a password" required>
          <i><span class="material-icons" id="visibilityBtn">
            visibility
            </span></i> </div>
            <hr class="mb-3">
         <input type="submit" id="signin" name="signin" value="Sign in!">
         <?php include('log1.php'); ?>
        </div>
        </div>
        <?php
        if(isset($incorrect) and ($incorrect == true) and isset($_POST["signin"])){
        echo "<br><p class='errorMsg'>Email address or password is incorrect</p>";
        $incorrect = false;
        }
        ?>
        <br>
        <div>Not registered yet? Register <a href="index.php">here</a></div>
    </form>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
    <div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script type="text/javascript">

const visibilityBtn = document.getElementById("visibilityBtn");

visibilityBtn.addEventListener("click", toggleVisibility);

function toggleVisibility(){
    const password = document.getElementById("password");
    if(password.type === "password"){
        password.type = "text"
    }else {
        password.type = "password"
    }
}
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
</body>
</html>
