<?php
session_start();

$pseudo = $password = "";

if(isset($_POST['submit'])){
	include("database.php");
	$mysql = connect();
	
	
	$pseudo = $_POST["pseudo"];
	$password = $_POST["password"];
	
	
	
	$result_get_user = get_user_from_login($mysql,$pseudo);
	$row = $result_get_user->fetch_assoc();
	$id_user = $row['id'];
	$email_user = $row['email'];
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	
	if(($pseudo == "") || ($password == "")){
		echo "Warning : Veuillez remplir tout les champs";
	}
	
	else{
		$check_info_result = check_user_informations($mysql,$pseudo,$password);
		if($check_info_result->fetch_assoc()){
			printf("<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=myprofil.php?id=%d\">",$id_user);
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['password'] = $password;
			$_SESSION['id'] = $id_user;
			$_SESSION['email'] = $email_user;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
		}
		else{
			echo "Error : Reessayer  ";
		}
	
	}
	
	
	close($mysql);
}

?>