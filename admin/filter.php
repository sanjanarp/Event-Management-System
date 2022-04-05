<!DOCTYPE html>
<html lang="en">
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
            <h1><span class="glyphicon glyphicon-filter" aria-hidden="true"></span>Filter</h1>
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
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users </a>
              <a href="filter.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter </a>
              <a href="venue_logs.php" class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Deleted Venues </a>
        </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Filters</h3><br>
                
              </div>
              <div class="panel-body">
              <form action="" method="post">
              <div class="booking-form">
                        <label for="Event Type" >Event Type</label> 
                        <div class="select">
                            <select name="events" id="events" >
                            <option></option>
                            <?php  
                            include('../connection.php');
                            $sql = "SELECT * from `event`";
                            $res = mysqli_query ($data, $sql);
                            while($row = mysqli_fetch_array($res)){
                              echo "<option>"; echo $row['name']; echo "</option>";
                            }
                            
                            ?>
                         </select>
                        
                         <button type="submit" name="save" class="btn btn-primary">GO</button>
                         <br>
                         <label for="Venue Type" >Venue Type</label> 
                         <div class="select">
                            <select name="venue" id="venue" >
                            <option></option>
                            <?php  
                           
                            $sql_ven = "SELECT * from `venue`";
                            $res_ven = mysqli_query ($data, $sql_ven);
                            while($row_ven = mysqli_fetch_array($res_ven)){
                              echo "<option>"; echo $row_ven['name']; echo "</option>";
                            }
                            
                            ?>
                         </select>
                        
                         <button type="submit" name="go" class="btn btn-primary">GO</button>
                         <br>
                         <label for="User" >User</label> 
                         <div class="select">
                            <select name="user" id="user" >
                            <option></option>
                            <?php  
                           
                            $sql_user = "SELECT * from `user`";
                            $res_user = mysqli_query ($data, $sql_user);
                            while($row_user = mysqli_fetch_array($res_user)){
                              echo "<option>"; echo $row_user['email']; echo "</option>";
                            }
                            
                            ?>
                         </select>
                        
                         <button type="submit" name="submit" class="btn btn-primary">GO</button>
                    </div>
             
              </div>
</form>
                <br>
             <table class="table table-striped table-hover">
                      <tr>
                        <th>#</th>
                        <th>Customer Information</th>
                        <th>Booking Information</th>
                        <th>Equipments</th>
                      </tr>
             <?php
if(isset($_POST['save'])){ 
  $i=1;
  $name =  isset($_POST['events']) ? $_POST['events'] : '';
 
  $sql_event_id = "SELECT * FROM `event` where `name`='$name'";
  $res_event_id = mysqli_query ($data, $sql_event_id);
  $row_event_id = mysqli_fetch_array($res_event_id);
  $event_id = $row_event_id['id'];

  $sql_view = "SELECT * FROM `venue_booking` where `event_id`='$event_id'";
  $res_view = mysqli_query($data, $sql_view);
  while($row = mysqli_fetch_array($res_view)
                       ){
                        echo "<tr>";
                        echo "<td> "; echo $i++ ;
                        echo"</td>";
                        echo "<td><p> NAME: "; echo $row["user_name"]."</p>";
                        echo "<p> EMAIL: "; echo $row["email"]."</p>";
                        echo "<p> CONTACT: " ;echo $row["user_phone"]."</p>" ;
                        echo"</td>";
                        $eid=$row["event_id"] ;
                        $sql_event_name = "SELECT `name` FROM `event` where `id` = '$eid' ";
                        $res_event_name = mysqli_query($data, $sql_event_name);
                        $row_event_name = mysqli_fetch_array($res_event_name);
                        echo "<td><p> EVENT NAME: "; echo $row_event_name["name"]."</p>";
                        $vid=$row["venue_id"] ;
                        $sql_venue = "SELECT * FROM `venue` where `id` = '$vid' ";
                        $res_venue = mysqli_query($data, $sql_venue);
                        $row_venue = mysqli_fetch_array($res_venue);
                        $id =  $row["id"];
                        $sql_eq = "SELECT * FROM `equipments` where `venue_booking_id` = '$id'";
                        $res_eq = mysqli_query($data, $sql_eq);
                        $row_eq = mysqli_fetch_array($res_eq);
                        echo "<p> VENUE NAME: " ;echo $row_venue["name"]."</p>" ;
                        echo "<p> VENUE ADDRESS: " ;echo $row_venue["address"]."</p>" ;
                        echo "<p> DATE: " ;echo $row["date"]."</p>" ;
                        echo "<p> AUDIENCE SIZE: " ;echo $row["audience_size"]."</p>" ;
                        $rate = ($row_eq["chairs_no"] + $row_eq["tables_no"] + $row_eq["lights_no"] + $row_eq["speakers_no"] + $row_eq["microphones_no"]) * 10 + $row_venue["rate"];
                        echo "<p> RATE: " ;echo $rate."</p>" ;
                        echo"</td>";
                       echo "<td>";
                       echo "<p> CHAIRS: " ;echo $row_eq["chairs_no"]."</p>" ;
                       echo "<p> TABLES: " ;echo $row_eq["tables_no"]."</p>" ;
                       echo "<p> LIGHTS: " ;echo $row_eq["lights_no"]."</p>" ;
                       echo "<p> SPEAKERS: " ;echo $row_eq["speakers_no"]."</p>" ;
                       echo "<p> MICROPHONES: " ;echo $row_eq["microphones_no"]."</p>" ;
                       echo" </td>";
                       }
  // echo "<meta http-equiv='refresh' content='0'>";
  // $data->close();
}

?>
<?php
if(isset($_POST['go'])){ 
  $i=1;
  $name =  isset($_POST['venue']) ? $_POST['venue'] : '';
 
  $sql_venue_id = "SELECT * FROM `venue` where `name`='$name'";
  $res_venue_id = mysqli_query ($data, $sql_venue_id);
  $row_venue_id = mysqli_fetch_array($res_venue_id);
  $venue_id = $row_venue_id['id'];

  $sql_v = "SELECT * FROM `venue_booking` where `venue_id`='$venue_id'";
  $res_v = mysqli_query($data, $sql_v);
  while($row = mysqli_fetch_array($res_v)
                       ){
                        echo "<tr>";
                        echo "<td> "; echo $i++ ;
                        echo"</td>";
                        echo "<td><p> NAME: "; echo $row["user_name"]."</p>";
                        echo "<p> EMAIL: "; echo $row["email"]."</p>";
                        echo "<p> CONTACT: " ;echo $row["user_phone"]."</p>" ;
                        echo"</td>";
                        $eid=$row["event_id"] ;
                        $sql_event_name = "SELECT `name` FROM `event` where `id` = '$eid' ";
                        $res_event_name = mysqli_query($data, $sql_event_name);
                        $row_event_name = mysqli_fetch_array($res_event_name);
                        echo "<td><p> EVENT NAME: "; echo $row_event_name["name"]."</p>";
                        $vid=$row["venue_id"] ;
                        $sql_venue = "SELECT * FROM `venue` where `id` = '$vid' ";
                        $res_venue = mysqli_query($data, $sql_venue);
                        $row_venue = mysqli_fetch_array($res_venue);
                        $id =  $row["id"];
                        $sql_eq = "SELECT * FROM `equipments` where `venue_booking_id` = '$id'";
                        $res_eq = mysqli_query($data, $sql_eq);
                        $row_eq = mysqli_fetch_array($res_eq);
                        echo "<p> VENUE NAME: " ;echo $row_venue["name"]."</p>" ;
                        echo "<p> VENUE ADDRESS: " ;echo $row_venue["address"]."</p>" ;
                        echo "<p> DATE: " ;echo $row["date"]."</p>" ;
                        echo "<p> AUDIENCE SIZE: " ;echo $row["audience_size"]."</p>" ;
                        $rate = ($row_eq["chairs_no"] + $row_eq["tables_no"] + $row_eq["lights_no"] + $row_eq["speakers_no"] + $row_eq["microphones_no"]) * 10 + $row_venue["rate"];
                        echo "<p> RATE: " ;echo $rate."</p>" ;
                        echo"</td>";
                       echo "<td>";
                       echo "<p> CHAIRS: " ;echo $row_eq["chairs_no"]."</p>" ;
                       echo "<p> TABLES: " ;echo $row_eq["tables_no"]."</p>" ;
                       echo "<p> LIGHTS: " ;echo $row_eq["lights_no"]."</p>" ;
                       echo "<p> SPEAKERS: " ;echo $row_eq["speakers_no"]."</p>" ;
                       echo "<p> MICROPHONES: " ;echo $row_eq["microphones_no"]."</p>" ;
                       echo" </td>";
                       }
  // echo "<meta http-equiv='refresh' content='0'>";
  
}

?>

            
              <?php
              if(isset($_POST['submit'])){ 
              $emailid = isset($_POST['user']) ? $_POST['user'] : '';
              $sql_sp = "CALL `getBookings`('$emailid')";
              $i=1; 
              if($res_sp = mysqli_query($data,$sql_sp)) {
                while($row_sp = mysqli_fetch_row($res_sp)){
                  //  print_r($row_sp);

                  echo "<br>";

                  echo "<tr>";
                        echo "<td> "; echo $i++ ;
                        echo"</td>";
                        echo "<td><p> NAME: "; echo $row_sp["1"]."</p>";
                        echo "<p> EMAIL: "; echo $row_sp["2"]."</p>";
                        echo "<p> CONTACT: " ;echo $row_sp["3"]."</p>" ;
                        echo"</td>";
                        echo "<td><p> EVENT ID: "; echo $row_sp["5"]."</p>";  
                        echo "<p> VENUE ID: "; echo $row_sp["4"]."</p>"; 
                        echo "<p> DATE: " ;echo $row_sp["6"]."</p>" ;
                        echo "<p> AUDIENCE SIZE: " ;echo $row_sp["7"]."</p>" ;  
                        echo "<td>";
                        echo "<p> CHAIRS: " ;echo $row_sp["9"]."</p>" ;
                        echo "<p> TABLES: " ;echo $row_sp["10"]."</p>" ;
                        echo "<p> LIGHTS: " ;echo $row_sp["11"]."</p>" ;
                        echo "<p> SPEAKERS: " ;echo $row_sp["12"]."</p>" ;
                        echo "<p> MICROPHONES: " ;echo $row_sp["13"]."</p>" ;
                        echo" </td>";
                        while(mysqli_next_result($data));
                }
                
               
            }
            
            //  else {
            //     $error = $data->errno . ' ' . $data->error;
            //     echo $error; 
            // }
           
             }
              ?>
             </table>
              </div>
          </div>
        </div>
      </div>
    </section>
    

    
          </div>
        </div>
      </div>
    </div>
    <?php
      $data->close();
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
