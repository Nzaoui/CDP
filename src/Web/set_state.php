<?php

include('database.php');
$mysql = connect();

$id = $_POST["id"];
$state = $_POST["state"];
$user = $_POST["user"];
$state = alter_state($mysql,$id,$state);
$user = alter_taskuser($mysql,$id,$user);

?>
