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
$user =$_SESSION['id'];
if($Password =="")
{
	
	echo '<script language="javascript">';
	echo 'alert("Veuillez absolument saisir votre ancien mot de passe ou un nouveau mot de passe")';
	echo '</script>';
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=myprofil.php?id='.$_SESSION["id"].'">';  
	
}else{
	$result = alter_user($mysql,$id,$FirstName,$LastName,$Pseudo,$Email,$Password );

	if($result==true)
	{
		 header("location:myprofil.php?id=".$_SESSION['id']);
	}
 
	close($mysql);
}



?>