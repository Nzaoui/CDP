<?php

$pseudo = $password = "";

if(isset($_POST['submit'])){
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
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.html">';
		}
		else{
			echo "Error : Reessayer  ";
		}
		/*while ($row = $check_info_result->fetch_assoc()) {
        echo 'First Name: '.$row['first_name'].'<br>';
        echo 'Last Name: '.$row['last_name'].'<br>';
        echo 'Login: '.$row['login'].'<br>';
		echo 'Email: '.$row['email'].'<br>';
		}*/
	}
	close($mysql);
}
?>