<!DOCTYPE html>
<html lang="en">
  <head>
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
            <h1><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Bookings List</h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default" type="button" data-toggle="modal" data-target="#addPage" >
                New Entry</button>
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
                
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                      <tr>
                        <th>#</th>
                        <th>Customer Information</th>
                        <th>Booking Information</th>
                        <th>Equipments</th>
                        <th>Operation</th>
                      </tr>
                      <?php  include('../connection.php'); ?>
                      <?php
                       $sql="SELECT * from `venue_booking`;";
                       $res = mysqli_query ($data, $sql);
                       $i=1;
                       while($row = mysqli_fetch_array($res)
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
                        // echo "<td>"; echo $row["description"]; echo" </td>";
                        
                        echo "<td>"; echo "<a class='btn btn-default' href='edit_bookings.php?id=$id'>Edit</a> <a class='btn btn-primary' href='delete_bookings.php?id=$id'>Delete</a>"; echo" </td>";
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

    <!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="" method="post">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">New Entry</h4>
              </div>
             <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" required>
                  </div>
              
              <div class="form-group">
                <label>Phone number</label>
                <input type="text" name="phone" class="form-control" placeholder="Contact" required>
              </div>

              <div class="form-group">
                    <label>Venue</label>
                    <input type="text" name="venue" class="form-control" placeholder="Venue name" required>
                  </div>
                  <div class="form-group">
                    <label>Event</label>
                    <input type="text" name="event" class="form-control" placeholder="Event name" required>
                  </div>
                  <div class="form-group">
                        <label for="Date">Date</label> 
                        <input type="date" name="date" id="Date" required>
                     </div>
                  <div class="form-group">
                    <label>Audience size</label>
                    <input type="number" name="size" class="form-control" placeholder="size" required>
                  </div>
                  
                    <label for="Equipments">Equipments</label><br>
                   <div class="form-group">
                        <label for="chairs">Chairs</label> 
                        <input type="number" class="form-control" name="chairs" id="chairs" placeholder="no of chairs" min="0" max="1000" maxlength="30" required>
                     </div>
              <div class="form-group">
                        <label for="Tables">Tables</label> 
                        <input type="number" class="form-control" name="tables" id="Tables" placeholder="no of Tables" min="0" max="100"maxlength="100px" required>
                     </div>
                   
                     <div class="form-group">
                        <label for="speakers">speakers</label> 
                        <input type="number" class="form-control" name="speakers" id="speakers" placeholder="no of speakers" min="0" max="10" required>
                     </div>
                  <div class="form-group">
                        <label for="Lights">Lights</label> 
                        <input type="number" class="form-control" name="lights" id="Lights" placeholder="no of Lights" min="0" max="15" required>
                     </div>
                    <div class="form-group">
                        <label for="Microphones">Microphones</label> 
                        <input type="number" class="form-control" name="microphones" id="Microphones" placeholder="no of Microphones" min="0" max="10" required>
                     </div>
                 
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="save" class="btn btn-primary">Save </button>
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
            
            $sql_vbeq = " SELECT * FROM `venue_booking` where `venue_id` = '$ven_id' and `date` = '$date'";
            $res_vbeq = mysqli_query($data, $sql_vbeq);
      if(mysqli_num_rows($res_vbeq) !=0){
        echo "<script>alert('Choose a different date or venue!');</script>";
        echo "<script> window.location = 'bookings_list.php'</script>";
      }  else {
            
             $sql_addbook = "INSERT INTO `user_info`.`venue_booking`( `user_name`, `email`, `user_phone`, `venue_id`, `event_id`, `date`, `audience_size`) VALUES ('$name','$email' ,'$phone_number','$ven_id','$eve_id','$date','$size' );";
             mysqli_query($data, $sql_addbook);
             
             $vbid="";
             $chairs =  isset($_POST['chairs']) ? $_POST['chairs'] : '';
             $tables =  isset($_POST['tables']) ? $_POST['tables'] : '';
             $speakers =  isset($_POST['speakers']) ? $_POST['speakers'] : '';
             $lights =  isset($_POST['lights']) ? $_POST['lights'] : '';
             $microphones =  isset($_POST['microphones']) ? $_POST['microphones'] : '';
             $sql_vbid = "SELECT * from `user_info`.`venue_booking` ORDER BY `id` DESC LIMIT 1;  ";
             $res_vbid = mysqli_query($data, $sql_vbid);
             while($row_vbid = mysqli_fetch_array($res_vbid)){
               $vbid = $row_vbid["id"];
             }
             $sql_equip = "INSERT INTO `user_info`.`equipments`( `chairs_no`, `tables_no`, `lights_no`, `speakers_no`, `microphones_no`, `venue_booking_id`) VALUES ('$chairs','$tables','$lights','$speakers','$microphones','$vbid' );"   ;
             $result= mysqli_query($data, $sql_equip);
              if($result)
             {
               echo "<script>alert('Event added successfully!');</script>";
               echo "<script> window.location = 'bookings_list.php'</script>";
             }
             }

          
             
      //        echo "<meta http-equiv='refresh' content='0'>";
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