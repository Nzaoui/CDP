<?php

session_start();

$pseudo = $password = "";

if(!empty($_POST['pseudo']) and !empty ($_POST['password'])){
	include("database.php");
	
	$pseudo = $_POST["pseudo"];

	$password = $_POST["password"];
	

	$mysql = connect();
	
	if(($pseudo == "") || ($password == "")){
		echo "Warning : Veuillez remplir tout les champs";
	}
	else{
		$check_info_result = check_user_informations($mysql,$pseudo,$password);
		if($check_info_result->fetch_assoc()){
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=myprofil.php">';
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['password'] = $password;
			
		}
		else{
			echo "Error : Reessayer  ";
		}
	
	}
	
	
	close($mysql);
}
?>