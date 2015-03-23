<?php

//These are the database parameters for use
$dsn = 'withheld';
$username = 'withheld';
$password = 'withheld';

//PDO METHOD
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

//This should become what is retrieved from the database
$data1 = array( 'salt' => "test" );

//Grab the userID from the get req
$id = $_GET["userID"];

//grab important section
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

//Query the Database
if($dbh){
	//prepared statement
	$sql2 = 'SELECT * FROM saltstore WHERE site=:site AND userid=:id';
	$stm = $dbh->prepare($sql2);
	$stm->bindParam(':site', $site);
	$stm->bindParam(':site', $id);
	$stm->execute();
	
	//Prepared statement for the query
	$sql = 'SELECT *
	    FROM saltstore
	    WHERE site= :site AND userID = :id';
	$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':site' => $site, ':id' => $id));
	$res = $sth->fetchAll();
	
	//Case that a site exists
	if($res){
		foreach ($res as $row) {
                	$retData = array('userid' => $row['userid'], 'site' => $row['site'], 'salt' => $row['salt']);
        	}
	}
	//Case that there is no entry
	else{
		$retData = array('salt' => 'none');
	}
	
}


//return section
$option = 1; 
header('Content-type: application/json');
if ( $option == 1 )
  echo json_encode( $retData );

?>
