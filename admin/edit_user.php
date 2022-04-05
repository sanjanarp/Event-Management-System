<!DOCTYPE html>
<html lang="en">
<?php 
 include('../connection.php'); 

 $user_id = $_GET["id"];
 $name =   '';
  $email = '';
  $phone_number ='';
  $usertype =  '';
 $sql_sel = "SELECT * FROM `user` where `id` = $user_id";
 $res = mysqli_query($data, $sql_sel);
 while($row = mysqli_fetch_array($res)){
     $name = $row["name"];
     $email = $row["email"];
     $phone_number = $row["phone_number"];
     $usertype = $row["usertype"];
 }
 
 ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Users</title>
    <link href="css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>
  <?php
if(isset($_POST["update"])){
    $name1 =  isset($_POST['name']) ? $_POST['name'] : '';
    $email1 = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number1 =  isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
    $usertype1 =  isset($_POST['usertype']) ? $_POST['usertype'] : '';

    if($email == $email1 && $phone_number == $phone_number1){
      $sql_update = "UPDATE `user_info`.`user` set `name`= '$name1' ,`usertype`='$usertype1'   where `id` = '$user_id' ";
      $result = mysqli_query($data, $sql_update);
      if($result)
    {
      echo "<script>alert('User information updated successfully!');</script>";
      echo "<script> window.location = 'users.php'</script>";
    }
    } else{

  $sql_email="SELECT * FROM `user` WHERE `email`= '$email1'";
  $sql_phone="SELECT * FROM `user` WHERE `phone_number`= '$phone_number1'";
  $db_email = mysqli_query($data, $sql_email);
  $db_phone = mysqli_query($data, $sql_phone);

  if( $email!= $email1 && mysqli_num_rows($db_email)!=0){
      $email_error = "Email already taken";
      echo "<script>alert('$email_error');</script>";
      echo "<script> window.location = 'users.php'</script>";
      unset($email_error);
  }
 elseif($phone_number!= $phone_number1 && mysqli_num_rows($db_phone)!=0){
    $phone_error = "Phone number already taken";
    echo "<script>alert('$phone_error');</script>";
    echo "<script> window.location = 'users.php'</script>";
    unset($phone_error);
   } else{

    $sql_update = "UPDATE `user_info`.`user` set `name`= '$name1' , `email` = '$email1',`phone_number`= '$phone_number1',`usertype`='$usertype1'   where `id` = '$user_id' ";
    $result = mysqli_query($data, $sql_update);
    if($result)
  {
    echo "<script>alert('User information updated successfully!');</script>";
    echo "<script> window.location = 'users.php'</script>";
  }
   
   }
  }
   $data->close();
}


?>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            
          </button>
          <a class="navbar-brand" href="#">EVENT MANAGEMENT</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
         
          <ul class="nav navbar-nav navbar-right">
             <li><a href="../login.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Users</h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="bookings_list.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Bookings List </a>
              <a href="events.php" class="list-group-item"><span class="glyphicon glyphicon-glass" aria-hidden="true"></span> Events </a>
              <a href="venues.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Venues </a>
              <a href="users.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users </a>
              <a href="filter.php" class="list-group-item"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter </a>
              <a href="venue_logs.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Deleted Venues </a>
        </div>
          </div>
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Users</h3>

              <div class="panel-body">
              <form action="" method="post">
      
      <div class="modal-body">
       <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Email"  value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group">
          <label>Phone number</label>
          <input type="text" name="phone_no" class="form-control" placeholder="Phone number" value="<?php echo $phone_number; ?>" required>
        </div>
       
        <div class="form-group">
          <label>User Type</label>
          <select style="color:black;" name="usertype" required>
          <option value="<?php echo $usertype;?>" hidden><?php echo $usertype;?></option>
           <option value="admin">admin</option>
            <option value="user">user</option>
          </select>
        </div>
        
      <div class="modal-footer">
      <a href="users.php">  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
        <button type="submit" name="update" class="btn btn-default">Save changes</button>
     
      </div>
    </form>
               
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>