<?php

session_start();

include("database.php");

$mysql = connect();


$id = $_POST['ID'];
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$Email=$_POST['Email'];
$Pseudo=$_POST['Pseudo'];
$Password=$_POST['Password'];

$result = alter_user($mysql,$id,$FirstName,$LastName,$Pseudo,$Email,$Password );

 
close($mysql);

 header("location:myprofil.php");
?>