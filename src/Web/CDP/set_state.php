<?php

include('database.php');
$mysql = connect();

$id = $_POST["id"];
$state = $_POST["state"];
$state = alter_state($mysql,$id,$state);


?>