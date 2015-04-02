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

//Get the username parameter
$username = $_GET['username'];


if($dbh){
	//Prepared statement for the query
        $sql = 'SELECT *
            FROM users
            WHERE username= :un';
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':un' => $username));
        $res = $sth->fetchAll();

	//Case that a site exists
        if($res){
                foreach ($res as $row) {
                        $retData = array('userid' => $row['userid']);               }
        }
        //Case that there is no entry
        else{
                $retData = array('userid' => 0);
        }


}

//OLD
$data1 = array( 'userID' => "1" );
$option = 1; 
header('Content-type: application/json');
if ( $option == 1 )
  echo json_encode( $retData );


?>
