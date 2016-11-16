<?php
	if (!isset($_SESSION['pseudo']) || !isset($_SESSION['password'])){
    	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=restricted.php">';
    	exit();
  	}
	$name = $description = $language = "";

	if(isset($_POST['submit'])){
		include("database.php");
		$mysql = connect();
		
		$name = $_POST["name"];
		$description = $_POST["description"];
		$language = $_POST["language"];
		$numSprint = $_POST["nbrSprint"];
		$lenghtSprint = $_POST["lenghtSprint"];
		$start_date = $_POST["startDate"];
		
		$owner = $_SESSION["id"];
		
		
		if(($name == "") || ($description == "") || ($language == "") || ($numSprint == "") || ($lenghtSprint == "") || ($start_date == "")){
			echo "Warning : Veuillez remplir tout les champs";
		}
		else{
			
			$check_addResult = add_project($mysql,$name,$description,$language,$owner);
			if($check_addResult == true){
				$project = get_project_byName($mysql, $name);
				$row = $project->fetch_array(MYSQLI_ASSOC);
				for($i = 0; $i < $numSprint; $i++){
					$end_date = date('Y-m-d', strtotime($start_date. ' + '.$lenghtSprint.'days'));
					$check_SprintAdd = add_sprint ($mysql, $row["id"], $start_date, $end_date);
					$start_date = date('Y-m-d', strtotime($end_date. ' + 1 days'));
					if($check_SprintAdd == true){
						echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.html">';
					}
					else{
						echo "Error : Creation Sprints  ";
					}
				}
			}			
			else{
				echo "Error : Ajout Projet  ";
			}
		}
		close($mysql);
	}
?>