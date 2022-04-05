<?php

include "../connection.php";

$id = $_GET["id"];
mysqli_query($data, "DELETE FROM `user_info`.`event` where `id`=$id;");

?>

<script type="text/javascript">
window.location = "events.php";
</script>