<?php

//These are the database parameters for use
$dsn = withheld;
$username = withheld;
$password = withheld;


//PDO METHOD
try {
    $dbh = new PDO($dsn, $username, $password);
    //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

//Grab the userID from the get req
$name = $_GET["username"];


if($dbh){
	$stmt = $dbh->prepare("INSERT INTO users (username) VALUES (?)");
	$stmt->bindParam(1, $name);
	$stmt->execute();
}

?>
