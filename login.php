<?php
// File:    process.php
// Author:  Derek Yannone

// For debugging:
error_reporting(E_ALL);
ini_set('display_errors', '1');

$dbms = 'mysql';
$host = 'localhost';
$database = 'dyannone_thesis';
$dsn = "$dbms:dbname=$database;host=$host";
$user = 'dyannone';
$password = 'downforthecount';



// See if there is an 'action' request.
if(!isset($_POST['action'])){
    die("No action given :(");
}

// Open connection to database.
// TODO add database connection code. The code below assume you set
// $dbh.
try {
	$dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
	die('Connection failed: '. $e->getMessage());
}

// Process the action; call the corresponding function to process it.
$result = $dbh->prepare('select name from users where name = :name and password = :password');
    $result->execute(array(
    ':name' => $name,
    ':password' => $password));



/**
 * Send update/notification
 * @param dbh The PDO database handle.
 */
function loginUser($dbh, $name, $password){
    $result = $dbh->prepare('select name from users where name = :name and password = :password');
    $result->execute(array(
    ':name' => $name,
    ':password' => $password));
}


?>