<!DOCTYPE html>
<html lang="en">
<?php 
 include('../connection.php'); 

 $venue_id = $_GET["id"];
 $name ="";
 $address ="";
 $description ="";
 $rate ="";
 $sql_sel = "SELECT * FROM `venue` where `id` = $venue_id";
 $res = mysqli_query($data, $sql_sel);
 while($row = mysqli_fetch_array($res)){
     $name = $row["name"];
     $address = $row["address"];
     $description = $row["description"];
     $rate = $row["rate"];
 }
 
 ?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Venues</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>
  <?php
if(isset($_POST["update"])){
    $name1 =  isset($_POST['name']) ? $_POST['name'] : '';
    $address1 =isset($_POST['address']) ? $_POST['address'] : '';
    $description1 = isset($_POST['description']) ? $_POST['description'] : '';
    $rate1 =  isset($_POST['rate']) ? $_POST['rate'] : '';

    $sql_name="SELECT * FROM `venue` WHERE `name`= '$name1'";
    $db_name = mysqli_query($data, $sql_name);
    $sql_add="SELECT * FROM `venue` WHERE `address`= '$address1'";
    $db_add = mysqli_query($data, $sql_add);
    if($name!= $name1 && mysqli_num_rows($db_name)!=0){
      $name_error = "Venue already exits";
      echo "<script>alert('$name_error');</script>";
      echo "<script> window.location = 'venues.php'</script>";
  } else if($address!= $address1 && mysqli_num_rows($db_add)!=0){
    $add_error = "Venue address already exits";
    echo "<script>alert('$add_error');</script>";
    echo "<script> window.location = 'venues.php'</script>";
}else {
    $sql_update = "UPDATE `user_info`.`venue` set `name`= '$name1' , `address`= '$address1', `description` = '$description1', `rate`='$rate1' where `id` = '$venue_id' ";
    $result = mysqli_query($data, $sql_update);
    if($result)
    {
      echo "<script>alert('Venue updated successfully!');</script>";
      echo "<script> window.location = 'venues.php'</script>";
    }
   
    
  }
  $data->close();
  unset($sql_name);
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
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Venue</h1>
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
              <a href="venues.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Venues </a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users </a>
              <a href="filter.php" class="list-group-item"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter </a>
              <a href="venue_logs.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Deleted Venues </a>
        </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Venues</h3><br>
                <div class="container-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="" id="manage-venue" method="post">
              <input type="hidden" name="id" value="">
              <div class="form-group row">
                <div class="col-md-5">
                  <label for="" class="control-label">Venue</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-5">
                  <label for="" class="control-label">Address</label>
                  <textarea name="address" id="address" class="form-control" cols="30" rows="5" required><?php echo $address; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-5">
                  <label for="" class="control-label">Short Description</label>
                  <textarea name="description" id="description" class="form-control" cols="30" rows="5" required><?php echo $description; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-5">
                  <label for="" class="control-label">Rate</label>
                  <input type="number" class="form-control text-right" step="any" name="rate"  value="<?php echo $rate; ?>" required>
                </div>
              </div>
              <!-- <div class="form-group">
                <div><label for="" class="control-label">Venue Images</label></div>
                <input type="file" id="chooseFile" multiple="multiple" onchange="displayIMG(this)" accept="image/x-png,image/gif,image/jpeg" style="display: none">
                <label for="chooseFile" id="choose"><strong>Choose File</strong></label>
                    <div id="drop">
                                        <span id="dname" class="text-center">Drop Files Here</span>
                                    </div>
                    <div id="list">
                    </div> -->
              </div>
              <div class="modal-footer">
              <a href="venues.php"> <button type="button" class="btn btn-default" >Close</button></a>
                <button type="submit" name="update" class="btn btn-default">Save changes</button>
              </div>
            </form>
          </div>  
              </div>
              </div>
          </div>
        </div>
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
