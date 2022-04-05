<!DOCTYPE html>
<html lang="en">
<head>
  <title>EVENT MANAGEMENT| Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  
  <link rel="stylesheet" href="style3.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

  <!DOCTYPE html>
<?php 


$host="localhost";
$user="root";
$password="";

session_start();


$data=mysqli_connect($host,$user,$password);
mysqli_select_db($data, "user_info");
if($data===false)
{
	die("connection error");
}

?>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      
      <a class="navbar-brand" href="#myPage">EVENT MANAGEMENT</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        <li><a href="index.php">EVENTS</a></li>
        <li><a href="venue.php">VENUES</a></li>
        <li><a href="profile.php">PROFILE</a></li>
        <li><a href="../login.php">LOGOUT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Welcome to our page</h1> 
  <p>We specialize in organizing events</p> 
  </div>

  <!-- venues -->
 <div id="venue" class="container-fluid text-center bg-grey ">
 
    <h1 class="text-center">List of our Venues</h1>
    <?php 
    $sql="SELECT * from `venue`;";
    $res = mysqli_query ($data, $sql);
  while($row = mysqli_fetch_array($res)):
     
    ?>
  
  <div class="m-auto">
  <div class="row-centerd ">
    <div class="col-md-4 col-xs-6 text-center">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1><?php echo ucwords($row['name']) ?></h1>
        </div>
        <div class="panel-body pb">
            <p class="meta">
                <i class="fas fa-tags"></i> Rate per hour:
                <strong><?php echo number_format($row['rate'],2) ?></strong>
              </p>
        </div>
        <hr>
        <div class="panel-body">
            
            <p><?php echo ucwords($row['address']) ?></p>
        </div>
        <hr>
        <div class="panel-body">
          
          <p><?php echo ucwords($row['description']) ?></p>
                                <?php $venue_id= $row['id']  ?>
                                <a href="../bookingpage/booking.php?id=<?php echo $venue_id; ?>"><button id="venue1">book</button></a>
        </div>
        
      </div>      
    </div> 
               </div>
                 </div>
     <?php endwhile; ?>


    <br><br><br>

    
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
      
      
      </body>
      </html>