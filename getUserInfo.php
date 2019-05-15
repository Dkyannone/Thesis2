<?php
require "conn.php";
$dbms = 'mysql';
$host = 'localhost';
$database = 'dyannone_thesis';
$dsn = "$dbms:dbname=$database;host=$host";
$user = 'dyannone';
$password = 'downforthecount';
try {
	$dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
	die('Connection failed: '. $e->getMessage());
}
$user_email = $_POST["email"];
$user_pass = $_POST["password"];


$statement = $dbh->prepare("select * from users where email = :email limit 1");
	$statement->execute(array(':handle' => $user_email));
	$res = $statement->fetch();
	$user_name = $res["name"]
	$user_surname = $res["surname"];
	$user_email = $res["email"];
	$user_sport = $res["sport"];
	$user_team = $res["team"];

foreach($result as $row){
    $checkName = $row['email'];
    $checkPass = $row['password'];
    
}

if($checkName == $user_name){
		echo "Welcome {$row['name']}";
}else {
		echo "Wrong Username or Pass";
}


?>