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
$userid = $_GET["userID"];
$site = $_GET["site"];
$salt = $_GET["salt"];
$len = $_GET["len"];
$rs = $_GET["reqSym"];
$rn = $_GET["reqNum"];

//fix the site
$spil = split('[.]', $site);
$i=0;
$mainSec = "";
foreach ($spil as $obj){
        $i = $i+1;
        if($i == 2){
                $siteFixed = $obj;
        }
}


//Insert the new salt
if($dbh){
        $stmt = $dbh->prepare("INSERT INTO saltstore (userid, site, salt, len, reqSym, reqNum) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $userid);
	$stmt->bindParam(2, $siteFixed);
        $stmt->bindParam(3, $salt);
        $stmt->bindParam(4, $len);
        $stmt->bindParam(5, $rs);
        $stmt->bindParam(6, $rn);
        $stmt->execute();
}

?>

