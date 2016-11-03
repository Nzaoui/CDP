<?php

$pseudo = $first_name = $last_name = $email = $password = $re_password = "";

if(isset($_POST['submit'])){
	include("database.php");
	
	$pseudo = $_POST["pseudo"];
	$first_name = $_POST["nom"];
	$last_name = $_POST["prenom"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$re_password = $_POST["re_password"];
	$mysql = connect();

	if(($pseudo == "") || ($first_name == "") || ($last_name == "") 
		|| ($email == "") || ($password == "") || ($re_password == "")){
		
		echo "Warning : Veuillez remplir tout les champs";
	}
	else{
		if($password == $re_password){
			$check_result = check_already_use($mysql,$pseudo,$email);
			if(($check_result["login"]==0)&&($check_result["email"]==0)){
				$add_result = add_user($mysql,$first_name,$last_name,$pseudo,$email,$password);
				if($add_result == TRUE){
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.html">';  
				}
				else{
				echo "Error : Ajout User ";
				}
			}
			else{
				echo "Warning : Email ou Login deja utilise";
			}
		}
		else{
			echo "Warning : Veuillez ressaisir le mot de pass";
		}
	}
	close($mysql);
}
?>