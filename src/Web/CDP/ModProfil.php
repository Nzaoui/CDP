<?php

session_start();
if (!isset($_SESSION['pseudo']) || !isset($_SESSION['password'])){
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=restricted.php">';
    exit();
}

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

 header("location:myprofil.php?id=".$_SESSION['id']);
?>