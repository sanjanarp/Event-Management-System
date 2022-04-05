<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


  
    <header class="homepage" >
        <nav id="navbar">
             <h1 id="logo">EVENT MANAGEMENT</h1>
                    <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="profile.php">PROFILE</a></li>
                    <li><a href="../login.php">LOGOUT</a></li>
                    </ul>
          </nav>
      </header>
      
<?php include('../log1.php'); ?>

<div class="container">
  <div class="card m-auto" style="width:400px">
    <h4 class="card-title">RECEIPT</h4>
    <img class="card-img-top m-auto" src="images/avtar.jpg" alt="Card image" style="width:100px; height: 100px">
    <div class="card-body">
      
      <p> <b>Name:  </b><?php echo $_SESSION['name'];?> <hr> </p>
      <p> <b>Email:  </b><?php echo $_SESSION['email'];?> <hr> </p>
      <p> <b>Contact:  </b><?php echo $_SESSION['phone_no'];?> <hr> </p>
      <?php 
      $id = $_GET["id"]; 
      $sql_vb = mysqli_query($data, "SELECT * FROM `user_info`.`venue_booking` where `id`=$id;");
      $sql_equip = mysqli_query($data, "SELECT * FROM `user_info`.`equipments` where `venue_booking_id`=$id;");
      $sql_event_name = "SELECT `name` FROM `event` e, `venue_booking` v where e.id = v.event_id and v.user_phone = ".$_SESSION['phone_no']."  ";
        
        $res_event_name = mysqli_query($data, $sql_event_name);
        $sql_venue = "SELECT * FROM `venue` v, `venue_booking` vb where v.id = vb.venue_id and vb.user_phone = ".$_SESSION['phone_no']."  ";
        $res_venue = mysqli_query($data, $sql_venue);
      while($row_vb = mysqli_fetch_array($sql_vb) 
       and $row_equipments = mysqli_fetch_array($sql_equip) 
       and $row_event_name = mysqli_fetch_array($res_event_name)
         and $row_venue = mysqli_fetch_array($res_venue) 
       ){
        echo "<p> <b>Event:  </b>"; echo $row_event_name["name"]; echo "<hr> </p>";
        echo "<p> <b>Venue Name:  </b>"; echo $row_venue["name"]; echo "<hr> </p>";
        echo "<p> <b>Venue Address:  </b>"; echo $row_venue["address"]; echo "<hr> </p>";
        echo "<p> <b>Venue Rate:  </b>"; echo $row_venue["rate"]; echo "<hr> </p>";
        $rate = ($row_equipments["chairs_no"] + $row_equipments["tables_no"] + $row_equipments["lights_no"] + $row_equipments["speakers_no"] + $row_equipments["microphones_no"]) * 10 + $row_venue["rate"];
        echo "<p> <b>Total Rate:  </b>"; echo $rate; echo "<hr> </p>";
       }
      ?>
      <center>
      <button class="btn btn-primary" onclick="javascript:window.print();" > Print Receipt </button>
    </center>
    </div>
  </div>
  <br>  
</div>
  

     
</body>

<style>
    .card-title {
    margin-bottom: 0.5rem;
    color: black;
    text-align: center;
}
.container {
    margin-top: 6rem !important ;
}
   
 #navbar{
    background:#7E5EC2;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: auto;
    padding: 0 30px;
    width: 100%;
    top:0;
    position: fixed;
    height: 60px;
    z-index: 2;
}
#navbar ul{
    display: flex;
    list-style: none;
}
#navbar ul a{
margin-right: 80px;
padding: 30px;
color: #fff;
text-decoration: none;    
}
#navbar ul a:hover{
    background: white;
    color:#7E5EC2;
}
table{
  margin: 20px;
  display: inline;
}
</style>
</html>
