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

$id = $_GET["userid"];
$site = $_GET["site"];
$spil = split('[.]', $site);
$i=0;
$mainSec = "";
foreach ($spil as $obj){
        $i = $i+1;
        if($i == 2){
                $mainSec = $obj;
        }
}

if($dbh){

        //Prepared statement for the query
        $sql = 'SELECT *
            FROM randomstore
            WHERE site= :site AND userID = :id';
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':site' => $mainSec, ':id' => $id));
        $res = $sth->fetchAll();


	 //Case that a site exists
        if($res){
                foreach ($res as $row) {
                        $retData = array('ranSym' => $row['ransym'], 'ranNum' => $row['rannum'], 'ranSymPos' => $row['ransympos'], 'ranNumPos' => $row['rannumpos'], 'ranCap' => $row['rancap'], 'ranCapPos' => $row['rancappos']);
                }
        }


}

//return section
$option = 1;
header('Content-type: application/json');
if ( $option == 1 )
  echo json_encode( $retData );



?>

