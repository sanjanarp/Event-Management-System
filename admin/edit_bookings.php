<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
 include('../connection.php'); 

 $id = $_GET["id"];
 $name =   '';
 $email = '';
 $phone_number ='';
 $event_id =  '';
 $venue_id =  '';
 $date =  '';
 $aud_size =  '';
 $sql_sel_booking = "SELECT * FROM `venue_booking` where `id` = $id";
 $res_sel_booking = mysqli_query($data, $sql_sel_booking);
 while($row = mysqli_fetch_array($res_sel_booking)){
     $name = $row["user_name"];
     $email = $row["email"];
     $phone_number = $row["user_phone"];
     $event_id = $row["event_id"];
     $venue_id = $row["venue_id"];
     $date = $row["date"];
     $aud_size = $row["audience_size"];
 }

 $sql_ven_name = "SELECT * FROM `venue` where `id` = $venue_id";
 $res_ven_name = mysqli_query($data, $sql_ven_name);
 $ven_name="";
 while($row_ven_name = mysqli_fetch_array($res_ven_name)){
  $ven_name= $row_ven_name["name"];
 }
 
 $sql_eve_name = "SELECT * FROM `event` where `id` = $event_id";
 $res_eve_name = mysqli_query($data, $sql_eve_name);
 $eve_name="";
 while($row_eve_name = mysqli_fetch_array($res_eve_name)){
  $eve_name= $row_eve_name["name"];
 }

 $sql_equipments = "SELECT * FROM `equipments` where `venue_booking_id`= $id";
 $res_equipments = mysqli_query($data,$sql_equipments);
 $table="";
 $chair="";
 $mic="";
 $speaker="";
 $light="";
 while($row_equipments = mysqli_fetch_array($res_equipments)){
    $table= $row_equipments["tables_no"];
    $chair= $row_equipments["chairs_no"];
    $mic= $row_equipments["microphones_no"];
    $light= $row_equipments["lights_no"];
    $speaker= $row_equipments["speakers_no"];
   }




 ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Venue List</title>
    <!-- Bootstrap core CSS -->
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
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Bookings List</h1>
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
              <a href="bookings_list.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Bookings List </a>
              <a href="events.php" class="list-group-item"><span class="glyphicon glyphicon-glass" aria-hidden="true"></span> Events </a>
              <a href="venues.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Venues </a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users </a>
              <a href="filter.php" class="list-group-item"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter </a>
              <a href="venue_logs.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Deleted Venues </a>
        </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Bookings List</h3><br>
              <div class="panel-body">
              
            <div class="modal-body">
              <!-- <div class="form-group">
                <label>Venue</label>
                <select name="" id="">
                    <option>......</option>
                    <option>......</option>
                    <option>......</option>
                </select>
              </div> -->
              <form action="" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
                  </div>
              
              <div class="form-group">
                <label>Phone number</label>
                <input type="text" name="phone" class="form-control" placeholder="Contact" value="<?php echo $phone_number; ?>" required>
              </div>

              <div class="form-group">
                    <label>Venue</label>
                    <input type="text" name="venue" class="form-control" placeholder="Venue name" value="<?php echo $ven_name; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Event</label>
                    <input type="text" name="event" class="form-control" placeholder="Event name" value="<?php echo $eve_name; ?>" required>
                  </div>
                  <div class="form-group">
                        <label for="Date">Date</label> 
                        <input style="color:black;" type="date" name="date" id="Date" value="<?php echo $date; ?>" required>
                     </div>
                  <div class="form-group">
                    <label>Audience size</label>
                    <input type="number" name="size" class="form-control" placeholder="size" value="<?php echo $aud_size; ?>" required>
                  </div>
                  
                    <label for="Equipments">Equipments</label><br>
                   <div class="form-group">
                        <label for="chairs">Chairs</label> 
                        <input type="number" class="form-control" name="chairs" id="chairs" placeholder="no of chairs" min="0" max="1000" value="<?php echo $chair; ?>" required>
                     </div>
              <div class="form-group">
                        <label for="Tables">Tables</label> 
                        <input type="number" class="form-control" name="tables" id="Tables" placeholder="no of Tables" min="0" max="1000" value="<?php echo $table; ?>" required>
                     </div>
                   
                     <div class="form-group">
                        <label for="speakers">speakers</label> 
                        <input type="number" class="form-control" name="speakers" id="speakers" placeholder="no of speakers" min="0" max="1000" value="<?php echo $speaker; ?>" required>
                     </div>
                  <div class="form-group">
                        <label for="Lights">Lights</label> 
                        <input type="number" class="form-control" name="lights" id="Lights" placeholder="no of Lights" min="0" max="1000" value="<?php echo $light; ?>" required>
                     </div>
                    <div class="form-group">
                        <label for="Microphones">Microphones</label> 
                        <input type="number" class="form-control" name="microphones" id="Microphones" placeholder="no of Microphones" min="0" max="1000" value="<?php echo $mic; ?>" required>
                     </div>
              
            <div class="modal-footer">
            <a href="bookings_list.php"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
              <button type="submit" name="save" class="btn btn-default">Save changes</button>
            </div>
        </div>
          </form>
          <?php

           if(isset($_POST['save'])){ 
            
             $name =  isset($_POST['name']) ? $_POST['name'] : '';
             $email =isset($_POST['email']) ? $_POST['email'] : '';
             $phone_number = isset($_POST['phone']) ? $_POST['phone'] : '';
             $venue =  isset($_POST['venue']) ? $_POST['venue'] : '';
             $event =  isset($_POST['event']) ? $_POST['event'] : '';
             $date =  isset($_POST['date']) ? $_POST['date'] : '';
             $size =  isset($_POST['size']) ? $_POST['size'] : '';

            $sql_ven = "SELECT * FROM `venue` WHERE `name`='$venue'";
            $res_ven = mysqli_query($data, $sql_ven);
            $row_ven = mysqli_fetch_array($res_ven);
            $ven_id = $row_ven['id'];
            
            $sql_eve = "SELECT * FROM `event` WHERE `name`='$event'";
            $res_eve = mysqli_query($data, $sql_eve);
            $row_eve = mysqli_fetch_array($res_eve);
            $eve_id = $row_eve['id'];
            
            $sql_vbeq = " SELECT * FROM `venue_booking` where `venue_id` = '$venue_id' and `date` = '$date'";
        $res_vbeq = mysqli_query($data, $sql_vbeq);
  if(mysqli_num_rows($res_vbeq) !=0){
    echo "<script>alert('Choose a different date or venue!');</script>";
    echo "<script> window.location = 'bookings_list.php'</script>";
  }  else {
            
             $sql_updatebook = "UPDATE `user_info`.`venue_booking` set `user_name`= '$name', `email` = '$email', `user_phone` = '$phone_number' , `venue_id` = '$ven_id', `event_id` = '$eve_id', `date` = '$date', `audience_size` = '$aud_size' where `id` = '$id';";
             $res = mysqli_query($data, $sql_updatebook);

             $chairs =  isset($_POST['chairs']) ? $_POST['chairs'] : '';
             $tables =  isset($_POST['tables']) ? $_POST['tables'] : '';
             $speakers =  isset($_POST['speakers']) ? $_POST['speakers'] : '';
             $lights =  isset($_POST['lights']) ? $_POST['lights'] : '';
             $microphones =  isset($_POST['microphones']) ? $_POST['microphones'] : '';

             $sql_equip = "UPDATE  `user_info`.`equipments` set `chairs_no` = '$chairs', `tables_no` = '$tables', `lights_no` = '$lights', `speakers_no` = '$speakers', `microphones_no` = '$microphones' where `venue_booking_id` = '$id' ;"   ;
             $result = mysqli_query($data, $sql_equip);
             if($result)
               {
                 echo "<script>alert('Booking information updated successfully!');</script>";
                 echo "<script> window.location = 'bookings_list.php'</script>";
               }
              }
             echo "<meta http-equiv='refresh' content='0'>";
             $data->close();
           }
           
           ?>
          </div>
        </div>
      </div>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>