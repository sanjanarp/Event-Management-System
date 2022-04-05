<?php

include "../connection.php";

$id = $_GET["id"];
mysqli_query($data, "DELETE FROM `user_info`.`venue_logs` where `id`=$id;");

?>

<script type="text/javascript">
window.location = "venue_logs.php";
</script>