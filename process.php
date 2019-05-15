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
$action = $_POST['action'];

// create user director.
if($action == "createuser"){
    if(!hasPostParams(['name', 'surname', 'email', 'password', 'sport', 'team']))
        die('Missing required parameters!');
    createUser($dbh, $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['sport'], $_POST['team']);

} else if($action == "createuser2"){
    if(!hasPostParams(['name', 'surname', 'email', 'password', 'sport', 'team']))
        die('Missing required parameters!');
    createUser($dbh, $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['sport'], $_POST['team']);

}else if($action == "pushnotification"){
    if(!hasPostParams(['content', 'team', 'sport', 'type']))
        die('Missing required parameters!');
    pushNotification($dbh, $_POST['content'], $_POST['team'], $_POST['sport'], $_POST['type']);

}else if($action == "createTeam"){
    if(!hasPostParams(['name', 'sport']))
        die('Missing required parameters!');
    createTeam($dbh, $_POST['name'], $_POST['sport']);

}else if($action == "createStatistic"){
    if(!hasPostParams(['playerId', 'teamId', 'gameId', 'type', 'num', 'sport']))
        die('Missing required parameters!');
    createStatistic($dbh, $_POST['playerId'], $_POST['teamId'], $_POST['gameId'], $_POST['type'], $_POST['num'], $_POST['sport']);

}else if($action == "createGame"){
    if(!hasPostParams(['sport', 'team', 'opponent', 'location', 'field', 'tournament']))
        die('Missing required parameters!');
    createGame($dbh, $_POST['sport'], $_POST['team'], $_POST['opponent'], $_POST['location'], $_POST['field'], $_POST['tournament']);

} else if($action == "deleteTeam"){
    if(!hasPostParams(['name']))
        die('Missing required parameters!');
    deleteTeam($dbh, $_POST['name']);
}else if($action == "deleteUser"){
    if(!hasPostParams(['email']))
        die('Missing required parameters!');
    deleteUser($dbh, $_POST['email']);
}else if($action == "getUserInfo"){
    if(!hasPostParams(['email']))
        die('Missing required parameters!');
    getUserInfo($dbh, $_POST['email']);
}else {
    die("Invalid action specified: {$_POST['action']}");
}

 /**
 * Get a user's information base on the handle input. 
 * @param dbh The PDO database handle.
 * @param handle
 */
function getUserInfo($dbh, $email){

    $statement = $dbh->prepare("select * from users where email = :email limit 1");
    $statement->execute(array(':email' => $email));
    $res = $statement->fetch();
    $name = $res['name'];
    $surname = $res['surname'];
    $email = $res['email'];
    $sport = $res['sport'];
    $team = $res['team'];
    $status = array('successful'=> 'true', 'name '=> $name, 'surname '=> $surname, 'email '=> $email, 'sport '=> $sport, 'team '=> $team);
    print json_encode($status);
 
}   
/**
 * Creates new director 
 * @param dbh The PDO database handle.
 */
function createDirector($dbh, $name, $surname, $email, $password, $sport, $team){
    $result = $dbh->prepare('insert into directors(name, surname, email, password, sport, team) values(:name, :surname, :email, :password, :sport, :team)');
    $result->execute(array(
    ':name' => $name,
    ':surname' => $surname,
    ':email' => $email,
    ':password' => $password,
    ':sport' => $sport,
    ':team' => $team));
    print "user created";
}

/**
 * Creates new user 
 * @param dbh The PDO database handle.
 */
function createUser($dbh, $name, $surname, $email, $password, $sport, $team){
    $result = $dbh->prepare('insert into users(name, surname, email, password, sport, team) values(:name, :surname, :email, :password, :sport, :team)');
    $result->execute(array(
    ':name' => $name,
    ':surname' => $surname,
    ':email' => $email,
    ':password' => $password,
    ':sport' => $sport,
    ':team' => $team));
    print "user created";
}

/**
 * Send update/notification
 * @param dbh The PDO database handle.
 */
function pushNotification($dbh, $content, $team, $sport, $type){
    $result = $dbh->prepare('insert into notifications(content, team, sport, type) values(:content, :team, :sport, :type)');
    $result->execute(array(
    ':content' => $content,
    ':team' => $team,
    ':sport' => $sport,
    ':type' => $type));
    print "notification sent";
}

/**
 * Creates new team 
 * @param dbh The PDO database handle.
 */
function createTeam($dbh, $name, $sport){
    $result = $dbh->prepare('insert into teams(name, sport) values(:name, :sport)');
    $result->execute(array(
    ':name' => $name,
    ':sport' => $sport));
    print "team created";
}

/**
 * Creates a game statistic
 * @param dbh The PDO database handle.
 */
function createStatistic($dbh, $playerId, $teamId, $gameId, $type, $num, $sport){
    $result = $dbh->prepare('insert into gameStats(playerId, teamId, gameId, type, num, sport) values(:playerId, :teamId, :gameId, :type, :num, :sport)');
    $result->execute(array(
    ':playerId' => $playerId,
    ':teamId' => $teamId,
    ':gameId' => $gameId,
    ':type' => $type,
    ':num' => $num,
    ':sport' => $sport));
    print "statistic created";
}

/**
 * Creates a game 
 * @param dbh The PDO database handle.
 */
function createGame($dbh, $sport, $team, $opponent, $location, $field, $tournament){
    $result = $dbh->prepare('insert into games(sport, team, opponent, location, field, tournament) values(:sport, :team, :opponent, :location, :field, :tournament)');
    $result->execute(array(
    ':sport' => $sport,
    ':team' => $team,
    ':opponent' => $opponent,
    ':location' => $location,
    ':field' => $field,
    ':tournament' => $tournament));
    print "game created";
}

/**
 * delete team
 * @param dbh The PDO database handle.
 */
function deleteTeam($dbh, $name){
    $result = $dbh->prepare('delete from teams where name = :name');
    $result->execute(array(
    ':name' => $name));
    print "team deleted";
}

/**
 * delete team
 * @param dbh The PDO database handle.
 */
function deleteUser($dbh, $email){
    $result = $dbh->prepare('delete from users where email = :email');
    $result->execute(array(
    ':email' => $email));
    print "user deleted";
}

/**
 * Checks if $_POST has each of the given parameters. If so, true is returned,
 * otherwise false.
 *
 * @param $params A list of parameters to check are set in $_POST.
 * @return Whether or not all of the params are set in $_POST.
 */
function hasPostParams($params){
    foreach($params as $param)
        if(!isset($_POST[$param]))
            return false;
    return true;
}
?>