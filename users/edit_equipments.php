<!DOCTYPE html>
<html lang="en">
<head>
  <title>Equipments</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400&display=swap" rel="stylesheet">
</head>
<body>


  
    <header class="homepage" >
        <nav id="navbar">
             <h1 id="logo">Event Management</h1>
                    <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="profile.php">PROFILE</a></li>
                    <li><a href="../login.php">LOGOUT</a></li>
                    </ul>
          </nav>
      </header>
      
<?php include('../connection.php');
 $id = $_GET["id"]; 
 $chairs ="";
 $tables ="";
 $lights ="";
 $speakers ="";
 $microphones ="";
 $sql_equip = mysqli_query($data, "SELECT * FROM `user_info`.`equipments` where `eid`=$id;");
 while($row_equipments = mysqli_fetch_array($sql_equip)){
  $chairs =$row_equipments["chairs_no"];
  $tables =$row_equipments["tables_no"];
  $lights =$row_equipments["lights_no"];
  $speakers =$row_equipments["speakers_no"];
  $microphones =$row_equipments["microphones_no"];
  $rate = ($row_equipments["chairs_no"] + $row_equipments["tables_no"] + $row_equipments["lights_no"] + $row_equipments["speakers_no"] + $row_equipments["microphones_no"]) * 10 ;
  
 }

?>

<div class="container">
  
      
      <?php 
      // $id = $_GET["id"]; 
      //  $sql_equip = mysqli_query($data, "SELECT * FROM `user_info`.`equipments` where `id`=$id;");
      // while( $row_equipments = mysqli_fetch_array($sql_equip)){
      //   echo "<p> <b>Chairs:  </b>"; echo $row_equipments["chairs_no"]; echo "<hr> </p>";
      //   echo "<p> <b>Tables:  </b>"; echo $row_equipments["tables_no"] ; echo "<hr> </p>";
      //   echo "<p> <b>Lights:  </b>"; echo $row_equipments["lights_no"]; echo "<hr> </p>";
      //   echo "<p> <b>Speakers:  </b>"; echo $row_equipments["speakers_no"]; echo "<hr> </p>";
      //   echo "<p> <b>Microphones:  </b>"; echo $row_equipments["microphones_no"]; echo "<hr> </p>";
    //   echo "<p> <b>Total Rate of Equipments:  </b>"; echo $rate; echo "<hr> </p>";
      //  }
      ?>
       <form action="" class="booking" method="post">
       <div class="homepage-content">
       <div class="equip booking-form">
                    <h2 class = "text-center">Equipments</h2>
                    <table>
                        <tr>
                     <td><div class="booking-form">
                        <label for="chairs">Chairs</label> 
                        <input type="number" name="chairs" id="chairs" placeholder="no of chairs" min="0" max="1000"   value="<?php echo $chairs; ?>" required>
                     </div>
                    </td>
                </tr>
                <table>
                    <tr>
                     <td><div class="booking-form">
                        <label for="Tables">Tables</label> 
                        <input type="number" name="tables" id="Tables" placeholder="no of Tables" min="0" max="1000"  value="<?php echo $tables; ?>"required>
                     </div>
                    </td>
                </tr>
                <tr>
                    <td>
                     <div class="booking-form">
                        <label for="speakers">speakers</label> 
                        <input type="number" name="speakers" id="speakers" placeholder="no of speakers" min="0" max="1000" value="<?php echo $speakers; ?>" required>
                     </div>
                    </td>
                </tr>
                <tr>
                    <td><div class="booking-form">
                        <label for="Lights">Lights</label> 
                        <input type="number" name="lights" id="Lights" placeholder="no of Lights" min="0" max="1500" value="<?php echo $lights; ?>" required>
                     </div>
                    </td>
                </tr>
                <tr>
                    <td><div class="booking-form">
                        <label for="Microphones">Microphones</label> 
                        <input type="number" name="microphones" id="Microphones" placeholder="no of Microphones" min="0" max="1000" value="<?php echo $microphones; ?>" required>
                     </div>
                    </td>
                </tr>
                    </table>
                </div> 

                    <div class="booking-form">
                        <input type="submit" name="update" value="Update" id="submit" class="btn">
                    </div>
                        
                  
      </form>
  
  <br>  
  <div class="booking-form">
                         <h1>Equipment Total rate : <?php echo $rate; ?></h1>
                     </div>
</div>
      </div>
  
      <?php 

if(isset($_POST["update"])){
    $chairs1 =  isset($_POST['chairs']) ? $_POST['chairs'] : '';
    $tables1 =isset($_POST['tables']) ? $_POST['tables'] : '';
    $speakers1 =isset($_POST['speakers']) ? $_POST['speakers'] : '';
    $lights1 =isset($_POST['lights']) ? $_POST['lights'] : '';
    $microphones1 =isset($_POST['microphones']) ? $_POST['microphones'] : '';
    $sql_update = "UPDATE `user_info`.`equipments` set `chairs_no`= '$chairs1' , `tables_no`= '$tables1', `speakers_no` = '$speakers1', `lights_no`= '$lights1', `microphones_no`= '$microphones1' where `eid` = '$id' ";
    mysqli_query($data, $sql_update);
    header("Location: profile.php");
}



?>
     
</body>



<style>
    *{
    box-sizing: border-box;
    margin: 0%;
    padding: 0%;
}
body{
    font-family: 'Montserrat', sans-serif;
    background-color: #B1D0E0;
    color: white;
    line-height: 1.8;
    /* background-image: linear-gradient(to right top, #675fd6, #6276df, #648ae4, #709de7, #82afe7); */
}
ul{
    list-style: none;
}
a{
     color: #fff;
    text-decoration: none;    
}

/* .button:hover{
        background: blueviolet;
} */
#navbar{
    background: #7E5EC2;
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
}
#navbar ul a{
margin-right: 80px;
padding: 30px;
}
#navbar ul a:hover{
    background: white;
    color:#7E5EC2;
}
.homepage-content{
    height: 900px;
} 
.homepage-content{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-top: 100px;
    color: #fff;
}
.homepage-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 900px;
    /* background: rgba(0,0,0,0.6);  */
}
.homepage-content * {
    z-index: 1;
}
.booking-form label{
    font-size: 30px;
    display: block;
}
.booking-form input{
    width:600px;
    height: 40px;
    margin:10px;
    padding: 10px;
    border-radius: 5px;
    border: none;
}
.booking-form input:focus {
    outline-color: black;
}
.btn{
    background: rgba(255, 255, 255, 0.6);
    cursor:pointer;
    font-size: 20px;
}
.btn:hover{
    background: rgba(255, 255, 255, 0.4);
}
select { 
    appearance: none;
    background-color: transparent;
    border: none;
    padding: 0 1em 0 0;
    margin: 0;
    width: 100%;
    font-family: inherit;
    font-size: inherit;
    cursor: inherit;
    line-height: inherit;
    outline: none;
  }
  .select {
    width: 100%;
    min-width: 15ch;
    max-width: 60ch;
    border: 1px solid var(--select-border);
    border-radius: 0.25em;
    padding: 0.35em 0.5em;
    font-size: 1.25rem;
    cursor: pointer;
    line-height: 1.5;
    background-color: #fff;
    display: grid;
    grid-template-areas: "select";

  }

</style>
</html>