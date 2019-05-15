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
$user_name = $_POST["email"];
$user_pass = $_POST["password"];
$result = $dbh->prepare("select * from users where email like :email and password like :password");
    $result->execute(array(
    ':email' => $user_name,
    ':password' => $user_pass));

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