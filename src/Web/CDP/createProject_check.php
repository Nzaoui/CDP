<?php
	session_start();

	$name = $description = $language = "";

	if(isset($_POST['submit'])){
		include("database.php");
		$mysql = connect();
		
		$name = $_POST["name"];
		$description = $_POST["description"];
		$language = $_POST["language"];
		$owner = $_SESSION["id"];
		
		
		if(($name == "") || ($description == "") || ($language == "")){
			echo "Warning : Veuillez remplir tout les champs";
		}
		else{
			$check_result = add_project($mysql,$name,$description,$language,$owner);
			if($check_result == true){
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.html">';
			}
			else{
				echo "Error : Ajout Projet  ";
			}
		}
		close($mysql);
	}
?>