<!DOCTYPE html>
<html lang="en">
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
            <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default" type="button" data-toggle="modal" data-target="#addPage" >
                add user</button>
              
            </div>
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
              </div>
              <div class="panel-body">
                
                <table class="table table-striped table-hover">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>User Type</th>
                        <th>Operation</th>
                      </tr>
                      <?php  include('../connection.php'); ?>
                     <?php
                      $sql="SELECT * from `user`;";
                       $res = mysqli_query ($data, $sql);
                       $i=1;
                       while($row = mysqli_fetch_array($res)){
                        echo "<tr>";
                        echo "<td>"; echo $i++; echo" </td>";
                        echo "<td>"; echo $row["name"]; echo" </td>";
                        echo "<td>"; echo $row["email"]; echo" </td>";
                        echo "<td>"; echo $row["phone_number"]; echo" </td>";
                        echo "<td>"; echo $row["usertype"]; echo" </td>";
                        $id =  $row["id"];
                        echo "<td>"; echo "<a class='btn btn-default' href='edit_user.php?id= $id'>Edit</a> <a class='btn btn-primary' href='delete_user.php?id= $id'>Delete</a>"; echo" </td>";
                        echo "</tr>";
                       }
                      ?>
                   </table>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New User</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
          <label>Name</label>
          <input type="text" name="username" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="emailid" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label>Phone number</label>
          <input type="text" name="phone_no" class="form-control" placeholder="Phone number" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="pass" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label>User Type</label>
          <select name="user_type" required>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
          </select>
        </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
     
      </div>
    </form>
    </div>
  </div>
</div>
<?php
if(isset($_POST['submit'])){ 
 
  $name =  isset($_POST['username']) ? $_POST['username'] : '';
  $email =isset($_POST['emailid']) ? $_POST['emailid'] : '';
  $phone_number = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
  $password =  isset($_POST['pass']) ? $_POST['pass'] : '';
  $usertype =  isset($_POST['user_type']) ? $_POST['user_type'] : '';

  $sql_email="SELECT * FROM `user` WHERE `email`= '$email'";
  $sql_phone="SELECT * FROM `user` WHERE `phone_number`= '$phone_number'";
  $db_email = mysqli_query($data, $sql_email);
  $db_phone = mysqli_query($data, $sql_phone);

  if(mysqli_num_rows($db_email)!=0){
      $email_error = "Email already taken";
      echo "<script>alert('$email_error');</script>";
      echo "<script> window.location = 'users.php'</script>";
      unset($email_error);
  }
 elseif(mysqli_num_rows($db_phone)!=0){
    $phone_error = "Phone number already taken";
    echo "<script>alert('$phone_error');</script>";
    echo "<script> window.location = 'users.php'</script>";

    unset($phone_error);
   } else{
  $sql_adduser = "INSERT INTO `user`(`name`, `email`, `phone_number`, `password`, `usertype`,`dt`) values ('$name','$email' ,'$phone_number','$password','$usertype',current_timestamp() );";
  $result = mysqli_query($data, $sql_adduser);
  if($result)
  {
    echo "<script>alert('User added successfully!');</script>";
    echo "<script> window.location = 'users.php'</script>";
  }
  echo "<meta http-equiv='refresh' content='0'>";
   }
  $data->close();
}
 
 
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
