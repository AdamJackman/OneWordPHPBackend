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
$userid = $_GET["userid"];
$site = $_GET["site"];
$rs = $_GET["nS"];
$rn = $_GET["nN"];
$rsp = $_GET["nSPos"];
$rnp = $_GET["nNPos"];
$rC = $_GET["rc"];
$rCP = $_GET["rcp"];

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
        $stmt = $dbh->prepare("INSERT INTO randomstore (userid, site, ransym, rannum, ransympos, rannumpos, rancap, rancappos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $userid);
        $stmt->bindParam(2, $siteFixed);
        $stmt->bindParam(3, $rs);
        $stmt->bindParam(4, $rn);
        $stmt->bindParam(5, $rsp);
        $stmt->bindParam(6, $rnp);
	$stmt->bindParam(7, $rC);
        $stmt->bindParam(8, $rCP);
        $stmt->execute();
}






?>

