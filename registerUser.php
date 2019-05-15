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
$user_name = $_POST["name"];
$user_pass = $_POST["password"];
$user_surname = $_POST["surname"];
$user_email = $_POST["email"];
$user_sport = $_POST["sport"];
$user_team = $_POST["team"];
$result = $dbh->prepare('insert into users(name, surname, email, password, sport, team) values(:name, :surname, :email, :password, :sport, :team)');
    $result->execute(array(
    ':name' => $user_name,
    ':surname' => $user_surname,
    ':email' => $user_email,
    ':password' => $user_password,
    ':sport' => $user_sport,
    ':team' => $user_team));

foreach($result as $row){
    $checkName = $row['email'];
    $checkPass = $row['password'];
    
}


?>