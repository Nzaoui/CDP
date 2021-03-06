<?php

/* WARNING */
/* THIS code requires the mysqlnd driver */
/* ON DEBIAN/UBUNTU => sudo apt-get install php5-mysqlnd */
/* ON WINDOWS => download driver on dev.mysql.com */

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
function check_user_informations ($mysql,$login,$passwd){
	$rqt = "SELECT first_name,last_name,login,email FROM User WHERE login=? AND password=?;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$hash_passwd = hash("sha256", $passwd);
	$stmt->bind_param("ss", $login,$hash_passwd);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*Return the user corresponding with id */
function get_user_from_login ($mysql,$login){
	$rqt = "SELECT id,first_name,last_name,login,email FROM User WHERE login=? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("s", $login);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*Return the user corresponding with id */
function get_user ($mysql,$id){
	$rqt = "SELECT id,first_name,last_name,login,email FROM User WHERE id=? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id);
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
	$hash_passwd = hash("sha256", $passwd);
	$stmt->bind_param("sssss", $first_name,$last_name,$login,$email,$hash_passwd);
	$stmt->execute();
	$result = $mysql->error;
	$stmt->close();
	return $result == "";
}

/*
	Alter an user in the database
	=> Return true if the user was altered, false otherwise
*/
function alter_user($mysql,$id,$first_name,$last_name,$login,$email,$passwd){
	$rqt = "UPDATE User SET first_name=?, last_name=?, login=? ,email=? ,password=? WHERE id=? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$hash_passwd = hash("sha256", $passwd);
	$stmt->bind_param("sssssi", $first_name,$last_name,$login,$email,$hash_passwd,$id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;
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

 /* Get all users by id and login */
function get_all_user ($mysql){
	$rqt = "SELECT id ,login FROM User ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
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

/*  -	Get the project's informations by name
 */
 function get_project_byName($mysql, $project_name){
 	$rqt = "SELECT * FROM Project WHERE name=? ;";
 	$stmt = $mysql->stmt_init();
 	$stmt = $mysql->prepare($rqt);
 	$stmt->bind_param("s", $project_name);
 	$stmt->execute();
 	$result = $stmt->get_result();
 	$stmt->close();
 	return $result;
 }


/*
	Insert into table, a new project following the arguments
	=> Return True if the project is stored
*/
function add_project($mysql,$name,$description,$language,$owner){
	$rqt = "INSERT INTO Project(name,description,language,owner) VALUES(?,?,?,?);";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("sssi", $name,$description,$language,$owner);
	$stmt->execute();
	$result = $mysql->error;
	$stmt-> close();
	return $result == "";
}

/*
	Alter project informations following the arguments
	=> Return True if the project is altered, False otherwise
*/
function alter_project ($mysql,$id,$name,$description,$language,$owner){
	$rqt = "UPDATE Project SET name=?, description=?, language=?,owner=? WHERE id=? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("sssii", $name,$description,$language,$owner,$id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt-> close();
	return $result==1;
}

/*
	Return all developers's informations working on a project, PO included
*/
function get_developers($mysql, $id_project){
	$rqt = "SELECT User.id, first_name,last_name,login,email
				FROM Project
				JOIN User ON Project.owner=User.id
				WHERE Project.id = ?
				UNION
				SELECT User.id,first_name,last_name,login,email
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

function delete_user_participation($mysql, $id_user, $id_project){
	$rqt = "DELETE FROM WorkOn
			WHERE id_user=? AND id_project=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ii", $id_user, $id_project);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;
}

/*
	Get all users not working on a project
*/
function get_potential_user_for_project ($mysql, $id_project){
	$rqt = "SELECT id, first_name, last_name, login
				FROM User
				WHERE id NOT IN (SELECT id_user FROM WorkOn WHERE id_project=?) AND
					id NOT IN (SELECT owner FROM Project WHERE id = ?);";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ii", $id_project, $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Check if a developer work on a project
	A developer work on a project if he was invited or if he is the PO
	=> Return True if is the case, False otherwise
*/
function check_user_work_on_project ($mysql, $id_user, $id_project){
	/*$rqt = "SELECT COUNT(id)
			FROM Project
			JOIN WorkOn ON Project.id=WorkOn.id_project
			WHERE (id_user = ? OR owner = ?) AND id_project = ?;";*/
	$rqt = "SELECT COUNT(idt)
			FROM(
				SELECT DISTINCT owner AS idt
				FROM Project
				WHERE Project.id = ? AND owner = ?
				UNION ALL
				SELECT DISTINCT id_user AS idt
				FROM WorkOn
				WHERE id_project = ? AND id_user = ?
			) x";

	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	//$stmt->bind_param("iii", $id_user, $id_user, $id_project);
	$stmt->bind_param("iiii", $id_project, $id_user, $id_project, $id_user);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_array(MYSQLI_NUM);
	$stmt->close();
	return $result[0]==1;
}

/*
	Add a User Story on a project
	Return True if the US was inserted, False otherwise
*/
function add_us($mysql, $id_project, $id_sprint, $description, $priority, $difficulty,$color){
	$rqt = "INSERT INTO UserStory(id_project,description,priority,id_sprint,difficulty,color)
				VALUES (?,?,?,?,?,?);";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("isiiis", $id_project, $description, $priority, $id_sprint, $difficulty,$color);
	$stmt->execute();
	$result = $mysql->error;
	$stmt->close();
	return $result=="";
}

/*
	Alter a User Story on a project
	The 3 last parameters can be NULL
	Return True if the US was altered, False otherwise
*/
function alter_us($mysql, $id, $id_project, $id_sprint, $description, $priority, $difficulty, $color, $achievement, $commit){
	$rqt = "UPDATE UserStory SET id_project=?, description=?, priority=?, difficulty=?, color=?, achievement=?, commit=?, id_sprint=?
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("isiisssii", $id_project, $description, $priority, $difficulty, $color, $achievement, $commit, $id_sprint, $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;
}

/*
	Get all User Stories of a project
*/
function get_us($mysql, $id_project){
	$rqt = "SELECT *
			FROM UserStory
			WHERE id_project=?
			ORDER BY id;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Get a User Story of a project by id
*/
function get_us_Byid($mysql, $id_project,$id){
	$rqt = "SELECT *
			FROM UserStory
			WHERE id_project=? AND id=?
			ORDER BY id;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ii", $id_project,$id);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Delete an User Story
*/
function delete_us ($mysql, $id){
	$rqt = "DELETE FROM UserStory
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;
}


function add_task($mysql,$id_sprint, $id_us,$description,$state){
	$rqt = "INSERT INTO Task(id_sprint,id_us,description,state)
				VALUES (?,?,?,?);";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("iiss", $id_sprint, $id_us, $description,$state);
	$stmt->execute();
	$result = $mysql->error;
	$stmt->close();
	return $result=="";
}

function alter_task($mysql,$id,$id_sprint,$id_us, $id_user, $description){
	$rqt = "UPDATE Task SET id_sprint=?, id_us=? , id_user=?, description=?
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("iiisi", $id_sprint, $id_us, $id_user, $description, $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;

}


function delete_task ($mysql, $id){
	$rqt = "DELETE FROM Task
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;
}

function alter_state($mysql,$id,$state){
	$rqt = "UPDATE Task SET state=?
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("si", $state, $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;

}

function alter_taskuser($mysql,$id,$id_user){
	$rqt = "UPDATE Task SET id_user=?
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ii", $id_user, $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;

}
/*
	Add a sprint to a project if:
		- start_date < end_date
		- the date interval is free
*/
function add_sprint ($mysql, $id_project, $start_date, $end_date){
	$rqt = "INSERT INTO Sprint(id_project,start_date,end_date)
				VALUES (?,?,?);";
	$s_date = new DateTime($start_date);
	$e_date = new DateTime($end_date);
	$result = "false";
	if( $s_date < $e_date ){
		$stmt = $mysql->prepare($rqt);
		$stmt->bind_param("iss", $id_project, $start_date, $end_date);
		$stmt->execute();
		$result = $mysql->error;
		$stmt->close();
	}
	return $result=="";
}

function get_sprints($mysql, $id_project){
	$rqt = "SELECT *
			FROM Sprint
			WHERE id_project=?
			ORDER BY start_date;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Delete a Sprint
*/
function delete_spint ($mysql, $id){
	$rqt = "DELETE FROM Sprint
			WHERE id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $mysql->affected_rows;
	$stmt->close();
	return $result==1;
}

function get_currents_sprints ($mysql, $id_project){
	$rqt = "SELECT *
			FROM Sprint
			WHERE id_project=? AND (start_date <= CURRENT_DATE AND end_date >= CURRENT_DATE)
			ORDER BY start_date;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

/*
	Get all passed sprints, including the actuals
*/
function get_past_sprints ($mysql, $id_project){
	$rqt = "SELECT *
			FROM Sprint
			WHERE id_project=? AND start_date <= CURRENT_DATE
			ORDER BY start_date;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

function get_tasks ($mysql, $id_sprint){
	$rqt = "SELECT *
			FROM Task
			WHERE id_sprint=?
			ORDER BY id;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_sprint);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

function get_project_difficulty($mysql,$id_project){
	$rqt = "SELECT SUM(difficulty)
				FROM Project
				JOIN UserStory ON UserStory.id_project = Project.id
				WHERE Project.id=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_project);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
	$stmt->close();
	return $result;
}

function get_sprint_difficulty ($mysql, $id_sprint){
	$rqt = "SELECT SUM(difficulty)
				FROM Sprint
				JOIN UserStory ON UserStory.id_sprint = Sprint.id
				WHERE id_sprint=? ;";
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("i", $id_sprint);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_array(MYSQLI_NUM)[0];
	$stmt->close();
	return ($result)?$result:0;
}

/*
Example of use functions
*/
/*$mysql = connect();
$result = get_currents_sprints($mysql,1);
//if ($result == true){echo "ok";}else {echo "ko";};
while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
                print "$r ";
            }
            print "\n";
        }

close($mysql);*/
?>
