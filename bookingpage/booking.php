
<!DOCTYPE html>
<?php
  include "../connection.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>booking</title>
</head>
<body>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400&display=swap" rel="stylesheet">
    
</head>
<body id="home">
    <header class="homepage">
        <nav id="navbar">

            
             <h1 id="logo">EVENT MANAGEMENT</h1>
                    <ul>
                    <li><a href="../users/index.php">Home</a></li>
                    </ul>
        </nav>  
            <div class="homepage-content">
                <h1>Book your event by filling your details here</h1>
                <form action="" class="booking" method="post">
                    <div class="booking-form">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" required>
                    </div>
                    <div class="booking-form">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email" required>
                    </div>
                    <div class="booking-form">
                       <label for="phone">Phone</label> 
                       <input type="text" name="phone_number" id="number" placeholder="Enter ph no" required>
                    </div>
                    <div class="booking-form">
                        <label for="Event Type" >Event Type</label> 
                        <div class="select">
                            <select name="events" id="events" required>
                            
                         <?php 
                            $sql1="SELECT * from `event`;";
                            $res1 = mysqli_query ($data, $sql1);
                         
                            while($row1 = mysqli_fetch_array($res1)):      
                         ?>
                
                        <option><?php echo ucwords($row1['name']) ?></option>
                        <?php endwhile; ?>
                         </select>
                    </div>
                    </div>
                    
                    <div class="booking-form">
                        <label for="Date">Date</label> 
                        <input type="date" name="date" id="Date" required>
                     </div>
                     <div class="booking-form">
                        <label for="size">No of audience</label> 
                        <input type="text" name="size" id="size" placeholder="Enter no of audience" required>
                     </div>
                    <div class="booking-form">
                        <input type="submit" name="submit" value="Confirm" id="submit" class="btn">
                    </div>
            </form>
            </div>
     </header>

     
<?php
if(isset($_POST["submit"])){ 
 
    $name =  isset($_POST['name']) ? $_POST['name'] : '';
    $email =isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $event =  isset($_POST['events']) ? $_POST['events'] : '';
    $date =  isset($_POST['date']) ? $_POST['date'] : '';
    $aud_size=isset($_POST['size']) ? $_POST['size'] : '';
    $venue_id = $_GET["id"];
  
  $sql_1 = "SELECT * FROM `venue_booking`";
  $res_sql_1 = mysqli_query($data, $sql_1);
  $count1=mysqli_num_rows($res_sql_1);

  $sql_eid = "SELECT * FROM `event` where `name` = '$event'";
  $res_eid = mysqli_query($data, $sql_eid);
 
 $row_eid = mysqli_fetch_array($res_eid);
  $eid = $row_eid['id'];

  $sql_vbeq = " SELECT * FROM `venue_booking` where `venue_id` = '$venue_id' and `date` = '$date'";
  $res_vbeq = mysqli_query($data, $sql_vbeq);
  if(mysqli_num_rows($res_vbeq) !=0){
    echo "<script>alert('Choose a different date!');</script>";
    echo "<script> window.location = 'booking.php'</script>";
  }  else {
  
  

  $sql = "INSERT INTO `user_info`.`venue_booking`(`user_name`,`email`, `user_phone`, `venue_id`, `event_id`, `date`, `audience_size`) values ('$name','$email' ,'$phone_number','$venue_id', '$eid','$date','$aud_size');";
 mysqli_query($data, $sql);
 
    //  echo $sql;
    $sql = "SELECT * FROM `venue_booking`";
    $res_sql = mysqli_query($data, $sql);
    $count=mysqli_num_rows($res_sql);

    $chairs =  $aud_size; 
    $tables =  $aud_size/2 ;
    $speakers = $aud_size>10 ? $aud_size/10 : 2;
    $lights = $aud_size>10 ? $aud_size/5 : 5 ;
    $microphones = $aud_size>10 ? $aud_size/15 : 3 ;

    if($count-$count1 == 1){
  
  $sql_vbi = "SELECT `id` from `user_info`.`venue_booking` ORDER BY `id` DESC LIMIT 1;  ";
  $res = mysqli_query($data, $sql_vbi);
  while($row = mysqli_fetch_array($res)){
    $id = $row["id"];
  }
  
  $sql_equip = "INSERT INTO `user_info`.`equipments`( `chairs_no`, `tables_no`, `lights_no`, `speakers_no`, `microphones_no`, `venue_booking_id`) VALUES ('$chairs','$tables','$lights','$speakers','$microphones','$id' );"   ;
  mysqli_query($data, $sql_equip);

}
  }
  $data->close();
    }
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- <script type="text/javascript">
     $(function(){
        $('#submit').click(function(){

            var valid = this.form.checkValidity();
            event.preventDefault();
            if(valid){
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#number').val();
            Swal.fire(
  'Congratulations!',
  'Event Booked',
  'success',
  
            
)
. then(function() {
window.location = "../users/index.php";
});
         } else {
            Swal.fire(
  'Error!',
  'Booking failed',
  'error'
)
         }
         });
       
     });
     </script> -->
</body>
</html>