<?php

$MYSQL_HOST = "localhost";
$MYSQL_USER = "gestionProjet";
$MYSQL_PASSWD = "M2-CDP";
$MYSQL_DATABASE = "GestionDeProjet";

//Return a mysql connection
function connect (){
	global $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWD, $MYSQL_DATABASE;
	$conn = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWD, $MYSQL_DATABASE);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

//close mysql connection
function close($mysql){
	$mysql->close();
}

/*Return the user corresponding with login AND password */
function get_user ($mysql,$login,$passwd){
	$rqt = "SELECT * FROM User WHERE login=? AND password=?;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ss", $login,hash("sha256", $passwd));
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/* 
	Add an user in the database 
	=> Return true if the user was created, false otherwise 
*/
function add_user($mysql,$first_name,$last_name,$login,$email,$passwd){
	$rqt = "INSERT INTO User(first_name,last_name,login,email,password) VALUES(?,?,?,?,?);";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("sssss", $first_name,$last_name,$login,$email,hash("sha256", $passwd));
	$stmt->execute();
	$result = $mysql->error;
	$stmt->close();
	if($result != "")
		return false;
	return true;
}

/* 
	Check if login ans email are already used 
	=> Return an array with 2 keys "login" and "email"
	=> if value equal 0 the element is not use
*/
function check_already_use ($mysql,$login,$email){
	$stmt = $mysql->stmt_init();

	$rqt = "SELECT * FROM User WHERE login=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("s", $login);
	$stmt->execute();
	$result["login"] = $stmt->get_result()->num_rows;

	$rqt = "SELECT * FROM User WHERE email=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result["email"] = $stmt->get_result()->num_rows;

	$stmt-> close(); 
	return $result;
}

/*
	Get all projects in the Table
*/
function get_projects($mysql){ 
	$rqt = "SELECT * FROM Project ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Get the project's informations
*/
function get_project($mysql, $id_project){ 
	$rqt = "SELECT * FROM Project WHERE id=? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Insert into table, a new project following the arguments
	=> Return True if the project is stored
*/
function add_project($mysql,$name,$description,$laguage,$owner){
	$rqt = "INSERT INTO Project(name,description,laguage,owner) VALUES(?,?,?,?);";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("sssi", $name,$description,$language,$owner);
	$stmt->execute();
	$result = $mysql->error;
	$stmt-> close();
	if($result != "")
		return false;
	return true;
}

/*
	Return all developers's informations working on a project, PO included
*/
function get_developers($mysql, $id_project){
	$rqt = "SELECT first_name,last_name,login,email 
				FROM Project 
				JOIN User ON Project.owner=User.id
				WHERE Project.id = ? 
				UNION 
				SELECT first_name,last_name,login,email 
				FROM User 
				JOIN WorkOn ON WorkOn.id_user=User.id 
				WHERE WorkOn.id_project = ? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ii", $id_project, $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Return all projects owned by a user
*/
function get_user_projects($mysql, $id_user){
	$rqt = "SELECT * 
				FROM Project 
				WHERE owner = ? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_user);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Return all projects where a user work on, without his projects
*/
function get_user_participations($mysql, $id_user){
	$rqt = "SELECT id, name, description, language, owner 
				FROM Project 
				JOIN WorkOn ON WorkOn.id_project=Project.id 
				WHERE WorkOn.id_user = ? AND Project.owner != ?;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ii", $id_user, $id_user);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Try to add a developer in a project
	=> Return false if the developer is already  working in the project or,
	 if the developer is the owner of the project
	=> Return true if the insertion was a success
*/
function add_user_to_project ($mysql, $id_user, $id_project){
	$ok = true;
	$rqt = "SELECT owner 
			FROM Project 
			WHERE id = ? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
	if ($result["owner"] == $id_user){
		$ok = false;
	}
	else{
		$rqt = "INSERT INTO WorkOn 
				VALUES (?,?);";
		$stmt = $mysql->prepare($rqt);
		$stmt->bind_param("ii", $id_user, $id_project);
		$stmt->execute();
		$result = $mysql->error;
		if ($result != "")
			$ok = false;
	}
	$stmt->close();
	return $ok;
}


/*
Example of use functions
*/
/*$mysql = connect();
$result = add_user_to_project($mysql,3,1);
if ($result == true){echo "ok";}else {echo "ko";};
/*while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
                print "$r ";
            }
            print "\n";
        }

close($mysql);*/
?>