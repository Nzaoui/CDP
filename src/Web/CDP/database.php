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

function check_already_use ($mysql,$login,$email){
	$rqt = "SELECT * FROM User WHERE login=? OR email=? ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ss", $login,$email);
	$stmt->execute();
	$result = $stmt->get_result()->num_rows;
	$stmt-> close(); 
	return $result != 0;
}

function get_projects($mysql){ 
	$rqt = "SELECT * FROM Project ;";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

function add_project($mysql,$name,$description,$laguage,$owner){
	$rqt = "INSERT INTO Project(name,description,laguage,owner) VALUES(?,?,?,?);";
	$stmt = $mysql->stmt_init();
	$stmt = $mysql->prepare($rqt);
	$stmt->bind_param("ssss", $name,$description,$language,$owner);
	$stmt->execute();
	$result = $mysql->error;
	$stmt-> close();
	if($result != "")
		return false;
	return true;
}

$mysql = connect();

$result = get_projects($mysql);
//echo $result ? 'true' : 'false';
while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
                print "$r ";
            }
            print "\n";
        }

close($mysql);
?>